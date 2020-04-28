<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo (isset($page_title))?' :: '.$page_title:''; ?></title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/admin.css');?>">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.mask.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/admin.js');?>"></script>

</head>
<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">

	<?php include('sidebar.php') ?>	


 	<div id="content-wrapper" class="d-flex flex-column">

		<div class="notifications mt-3">
			<?php
			//lets have the flashdata overright "$message" if it exists
			if($this->session->flashdata('message'))
			{
				$message	= $this->session->flashdata('message');
			}
			
			if($this->session->flashdata('error'))
			{
				$error	= $this->session->flashdata('error');
			}
			
			if(function_exists('validation_errors') && validation_errors() != '')
			{
				$error	= validation_errors();
			}
			?>
			
			<?php if (!empty($message)): ?>
				<div class="alert alert-success" role="alert">
					<a class="close" data-dismiss="alert">×</a>
					<?php echo $message; ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($error)): ?>
				<div class="alert alert-danger" role="alert">
					<a class="close" data-dismiss="alert">×</a>
					<?php echo $error; ?>
				</div>
			<?php endif; ?>
		</div>		

		<?php if(!empty($page_title)):?>
			<div class="page-header">
				<h1><?php echo  $page_title; ?></h1>
			</div>
		<?php endif;?>