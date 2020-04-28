<?php echo form_open($this->config->item('admin_folder').'/admin/form/'.$id); ?>
	<div class="form-row">
		<div class="form-group col">
			<label><?php echo lang('firstname');?></label>
			<?php
			$data	= array('name'=>'firstname', 'value'=>set_value('firstname', $firstname), 'class'=>"form-control");
			echo form_input($data);
			?>
		</div>
		<div class="form-group col">
			<label><?php echo lang('lastname');?></label>
			<?php
			$data	= array('name'=>'lastname', 'value'=>set_value('lastname', $lastname), 'class'=>"form-control");
			echo form_input($data);
			?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col">
			<label><?php echo lang('email');?></label>
			<?php
			$data	= array('name'=>'email', 'value'=>set_value('email', $email), 'class'=>"form-control");
			echo form_input($data);
			?>
		</div>
		<div class="form-group col">
			<label><?php echo lang('access');?></label>
			<?php
			$options = array(	'Admin'			=> 'Administrador',
								'Finance'		=> 'Financeiro',
								'Orders'		=> 'Atendimento',
								'None'			=> 'Nenhum'
							);
			echo form_dropdown('access', $options, set_value('access', $access),'class="custom-select"');
			?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col">
			<label><?php echo lang('password');?></label>
			<?php
			$data	= array('name'=>'password','class'=>"form-control");
			echo form_password($data);
			?>
		</div>
		<div class="form-group col">
			<label><?php echo lang('confirm_password');?></label>
			<?php
			$data	= array('name'=>'confirm','class'=>"form-control");
			echo form_password($data);
			?>
		</div>
	</div>
	<div class="form-actions">
		<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
	</div>
	
</form>
<script type="text/javascript">
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});
</script>