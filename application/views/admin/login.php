<?php include('header.php');?>

<style type="text/css">
html, body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-align: center;
  -ms-flex-pack: center;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #4e73df;
}

.form-user {
  width: 100%;
  max-width: 500px;
  padding: 15px;
  margin: 0 auto;
}
.form-user .checkbox {
  font-weight: 400;
  margin-top: 10px;
}
.form-user .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-user .form-control:focus {
  z-index: 2;
}
#wrapper #content-wrapper { background:none; }

section { background-color: white; border: 1px solid #ddd; border-radius: 5px; padding: 5px 3px; }
</style>
<div class="text-center">
  <?php echo form_open($this->config->item('admin_folder').'/login', 'class="form-user user" name="form-user"') ?>
    <section class="p-5"> 
  		<img class="mb-4" src="<?php echo base_url('assets/img/logo.png');?>" alt="" width="72" height="72">
  		<h1 class="h3 mb-3 font-weight-normal">Acesso  administrativo</h1>
  		<label for="inputEmail" class="sr-only"><?php echo lang('email');?></label>
  		<input type="email" name="email" id="inputEmail" class="form-control" placeholder="<?php echo lang('email');?>" required autofocus>
  		<label for="inputPassword" class="sr-only"><?php echo lang('password');?></label>
  		<input type="password" name="password" id="inputPassword" class="form-control" placeholder="<?php echo lang('password');?>" required>
  		<div class="checkbox mb-3">
  			<label>
  				<?php echo form_checkbox(array('name'=>'remember', 'value'=>'true'))?>
  				<?php echo lang('stay_logged_in');?>
  			</label>
  		</div>
  		<button class="btn btn-primary btn-user btn-block" type="submit"><?php echo lang('login');?></button>
  		<input type="hidden" value="<?php echo $redirect; ?>" name="redirect"/>
  		<input type="hidden" value="submitted" name="submitted"/>
    </section>
  <?php echo  form_close(); ?>
</div>

<?php include('footer.php');?>