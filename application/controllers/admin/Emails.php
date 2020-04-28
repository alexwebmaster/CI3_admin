<?php
class Emails extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);

		$this->lang->load('emails');
		$this->load->model(array('Email_model','Newsletter_model'));
		$this->load->helper('date');
	}
		
	function index()
	{
		$data['emails']		= $this->Email_model->get_campaigns();
		$data['page_title']	= lang('emails');
		
		$this->load->view($this->config->item('admin_folder').'/emails', $data);
	}
	
	function delete($id)
	{
		$this->Email_model->delete($id);
		$this->session->set_flashdata('message', lang('message_delete_email'));
		redirect($this->config->item('admin_folder').'/emails');
	}
	
	/********************************************************************
	this function is called by an ajax script, it re-sorts the emails
	********************************************************************/
	function organize()
	{
		$emails = $this->input->post('emails');
		$this->Email_model->organize($emails);
	}
	
	function form($id = false)
	{		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data	= array(	 'id'=>$id
							,'from_name'=>''
							,'from_email'=>''
							,'title'=>''
							,'enable_on'=>''
							,'disable_on'=>''
							,'image'=>''
							,'html'=>''
						);
		if($id)
		{
			$data				= (array) $this->Email_model->get_campaign($id);
			$data['enable_on']	= format_mdy($data['enable_on']);
			$data['disable_on']	= format_mdy($data['disable_on']);
		}

		$data['page_title']	= lang('email_form');
		
		$this->form_validation->set_rules('from_name', 'Enviador por:', 'required|max_length[128]');
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required|full_decode');
		$this->form_validation->set_rules('enable_on', 'lang:enable_on', 'trim');
		$this->form_validation->set_rules('disable_on', 'lang:disable_on', 'trim|callback_date_check');
		$this->form_validation->set_rules('image', 'lang:image', 'trim');
		$this->form_validation->set_rules('html', 'lang:html', 'trim');
		
		if ($this->form_validation->run() == false)
		{
			$data['error'] = validation_errors();
			$this->load->view($this->config->item('admin_folder').'/email_form', $data);
		}
		else
		{	
			
			$save['from_name']		= $this->input->post('from_name');
			$save['from_email']		= $this->input->post('from_email');
			$save['title']			= $this->input->post('title');
			$save['enable_on']		= format_ymd($this->input->post('enable_on'));
			$save['disable_on']		= format_ymd($this->input->post('disable_on'));
			$save['html']			= str_replace( 'src="/uploads/', 'src="'.base_url().'uploads/',$this->input->post('html'));

			if ($id)
			{
				$save['id']	= $id;				
			}

			
			$this->Email_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_email_saved'));
			
			redirect($this->config->item('admin_folder').'/emails');
		}	
	}

	function follow_campaign($id)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$email		= $this->Email_model->get_campaign($id);
		$emailSent	= $this->Email_model->get_campaign_sent($id);

		//set the default values
		$data	= array( 	'id'=>$id
							,'campaign_id'=>''
							,'name'=>''
							,'last_sent'=>''
							,'failed'=>''
						);

		$data['page_title']		= 'Campanha';
		$data['preview']		= $email->html;
		$data['campaign_id']	= $id;

		if($emailSent)
		{
			$data['id']				= $emailSent->id;
			$data['name']			= $emailSent->name;
			$data['last_sent']		= $emailSent->last_sent;
			$data['failed']			= $emailSent->failed;
			
		}

		$this->load->view($this->config->item('admin_folder').'/follow_campaign', $data);
	}
	
	function send_campaign_to_customers($campaign_id)
	{
		$lastSent = 0;
		$fail =  array();
		$campaign_sent = array();
		$total = $this->Customer_model->count_customers();

		//Busca campanha já cadastrada
		$campaign  = $this->Email_model->get_campaign($campaign_id);

		//Verifica se há essa campanha na tabela de campanhas enviadas.
		$verify_campaign = $this->Email_model->check_campaign_sender($campaign_id);

		$duplicatedEmail = $this->Email_model->check_duplicated_email();

		if(!empty($duplicatedEmail))
		{
			foreach ($duplicatedEmail as $idx => $value) {
				$this->Email_model->delete_from_newsletter($value->email_id);
			}
		}

		// Verifica se a campanha será retomada do ponto de onde pararam os envios, ou seja, "Resumir Campanha".
		if($this->input->post('keepON') == 'true')
		{
			if(!empty($verify_campaign))
			{
				if($verify_campaign->last_sent >= $total)
				{
					$result = array(
						'sent' => $verify_campaign->last_sent,
						'total' => $total
					);
					echo json_encode($result);
					exit();
				}else{
					$lastSent 	= $verify_campaign->last_sent;

					$fail = (!empty($verify_campaign->failed)) ? json_decode($verify_campaign->failed) : '';
				}
			}
		}
		
		// se o envio for ambos para clientes e newsletter
		if($_POST['sendTo'] == 'todos')
		{
			//Busca e-mails em newsletter para envio
			$newsletter = $this->Newsletter_model->get_newsletter_emails(1, $lastSent);
			if(!empty($newsletter))
			{
				$mail_newsletter;
				$mail_newsletter->from_email = $campaign->from_email;
				$mail_newsletter->from_name =  $campaign->from_name;
				$mail_newsletter->email =  $newsletter[0]->email;
				$mail_newsletter->title =  $campaign->title;
				$mail_newsletter->html =  $campaign->html;

				$this->send_email($mail_newsletter);
			}
		}
				
		//Busca e-mails dos clientes para envio
		$customers = $this->Customer_model->get_customers(1, $lastSent);

		$mail;
		$mail->from_email = $campaign->from_email;
		$mail->from_name =  $campaign->from_name;
		$mail->email =  $customers[0]->email;
		$mail->title =  $campaign->title;
		$mail->html =  $campaign->html;

		if($lastSent != 0 ){
			$campaign_sent['last_sent'] 	= $lastSent + 1;
		}else{
			$campaign_sent['last_sent']  = 1;
		}
		
		if(!$this->send_email($mail))
		{
			$fail = array_push($fail, $customers[0]->id);
		}

		$campaign_sent['id'] 			= (isset($verify_campaign->id)) ? $verify_campaign->id : NULL;
		$campaign_sent['failed'] 		= (empty($fail)) ? NULL : json_encode($fail);
		$campaign_sent['campaign_id'] 	= $campaign_id;
		$campaign_sent['name'] 			= ucwords($this->input->post('name'));

		//Salva a campanha em "campanhas enviadas"
		$save = $this->Email_model->save_send_customer_campaign($campaign_sent);

		$result = array(
					'sent' => intval($campaign_sent['last_sent']),
					'total' => intval($total)
				);
		echo json_encode($result);
	}

	function send_campaign_to_newsletter($campaign_id)
	{
		$lastSent = 0;
		$fail =  array();
		$campaign_sent = array();
		$total = $this->Newsletter_model->count_newsletters();

		//Busca campanha já cadastrada
		$campaign  = $this->Email_model->get_campaign($campaign_id);

		//Verifica se há essa campanha na tabela de campanhas enviadas.
		$verify_campaign = $this->Email_model->check_newsletter_sender($campaign_id);

		// Verifica se a campanha será retomada do ponto de onde pararam os envios, ou seja, "Resumir Campanha".
		if($this->input->post('keepON') == 'true')
		{
			if(!empty($verify_campaign))
			{
				if($verify_campaign->last_sent >= $total)
				{
					$result = array(
						'sent' => $verify_campaign->last_sent,
						'total' => $total
					);
					echo json_encode($result);
					exit();
				}else{
					$lastSent 	= $verify_campaign->last_sent;

					$fail = (!empty($verify_campaign->failed)) ? json_decode($verify_campaign->failed) : '';
				}
			}
		}
		
		//Busca e-mails em 'newsletter'
		$newsletter = $this->Newsletter_model->get_newsletter_emails(1, $lastSent);

		$mail;
		$mail->from_email = $campaign->from_email;
		$mail->from_name =  $campaign->from_name;
		$mail->email =  $newsletter[0]->email;
		$mail->title =  $campaign->title;
		$mail->html =  $campaign->html;

		if($lastSent != 0 ){
			$campaign_sent['last_sent'] 	= $lastSent + 1;
		}else{
			$campaign_sent['last_sent']  = 1;
		}
		
		if(!$this->send_email($mail))
		{
			$fail = array_push($fail, $newsletter[0]->id);
		}

		$campaign_sent['id'] 			= (isset($verify_campaign->id)) ? $verify_campaign->id : NULL;
		$campaign_sent['failed'] 		= (empty($fail)) ? NULL : json_encode($fail);
		$campaign_sent['campaign_id'] 	= $campaign_id;
		$campaign_sent['name'] 			= ucwords($this->input->post('name'));

		//Salva a campanha em "campanhas enviadas"
		$save = $this->Email_model->save_send_newsletter_campaign($campaign_sent);


		$result = array(
					'sent' => intval($campaign_sent['last_sent']),
					'total' => intval($total)
				);
		echo json_encode($result);
	}

	function do_action()
	{
		if (isset($_POST['sendTo']) && ($_POST['sendTo'] == 'newsletter') )
		{
			$this->send_campaign_to_newsletter($_POST['campaign_id']);
		}else{
			$this->send_campaign_to_customers($_POST['campaign_id']);
		}
	}

	function date_check()
	{
		
		if ($this->input->post('disable_on') != '')
		{
			if (format_ymd($this->input->post('disable_on')) <= format_ymd($this->input->post('enable_on')))
			{
				$this->form_validation->set_message('date_check', lang('date_error'));
				return FALSE;
			}
		}
		
		return TRUE;
	}

	function test_email($id)
	{
		if ($this->input->post('test_email') != '')
		{
			$email = $this->Email_model->get_campaign($id);
			if ($email->html)
			{	
				$email->email = $this->input->post('test_email');
				$status = $this->send_email($email);
				if( $status && ($this->input->post('ajax') == 1)){
					echo json_encode(array('status' => $status ) );
				}
				return true;
			}
		}
		return false;
	}

	function send_email($send_email)
	{
		$this->load->helper('string');

		$this->load->library('email');
		
		$this->email->from($send_email->from_email, $send_email->from_name);
		$this->email->to($send_email->email);
		$this->email->subject($this->config->item('site_name').' | '. $send_email->title);
		$this->email->message($send_email->html .' .');
		
		if ($this->email->send()){
			return true;
		}else{
			return false;
		}
	}	
}