<?php if($this->auth->is_logged_in(false, false)):?>

	<?php $admin_url = site_url($this->config->item('admin_folder')).'/';?>
		<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
	      <a class="navbar-brand" href="<?php echo $admin_url;?>dashboard">Dashboard</a>
	      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
	        <span class="navbar-toggler-icon"></span>
	      </button>

	      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
	        <ul class="navbar-nav mr-auto">

		        <?php
		        // Restrict access to Admins only
		        if($this->auth->check_access('Admin')) : ?>
	          	<li  class="nav-item dropdown">
		            <div class="dropdown-menu">
		                <a class="dropdown-item" href="<?php echo $admin_url;?>reports"><?php echo lang('common_reports') ?></a>
		            </div>
		        </li>
		        <li  class="nav-item dropdown">
		            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo lang('common_catalog') ?> <b class="caret"></b></a>
		            <div class="dropdown-menu">
		                <a class="dropdown-item" href="<?php echo $admin_url;?>categories"><?php echo lang('common_categories') ?></a>
		            </div>
		        </li>
		        <li  class="nav-item dropdown">
		            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo lang('common_content') ?> <b class="caret"></b></a>
		            <div class="dropdown-menu">
		                <a class="dropdown-item" href="<?php echo $admin_url;?>banners"><?php echo lang('common_banners') ?></a>
		                <a class="dropdown-item" href="<?php echo $admin_url;?>pages"><?php echo lang('common_pages') ?></a>
		            </div>
		        </li>
		         <li  class="nav-item dropdown">
		            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo lang('common_administrative') ?> <b class="caret"></b></a>
		            <div class="dropdown-menu">
		                <a class="dropdown-item" href="<?php echo $admin_url;?>settings"><?php echo lang('common_cart_configuration') ?></a>
		                <a class="dropdown-item" href="<?php echo $admin_url;?>settings/canned_messages"><?php echo lang('common_canned_messages') ?></a>
		                <a class="dropdown-item" href="<?php echo $admin_url;?>locations"><?php echo lang('common_locations') ?></a>
		                <a class="dropdown-item" href="<?php echo $admin_url;?>admin"><?php echo lang('common_administrators') ?></a>
		            </div>
		        </li>
		        <?php endif; ?>

	        </ul>

	        <ul class="navbar-nav float-right">
	          <li class="nav-item dropdown ">
	            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="dropdown_actions"  >
	            	<?php echo lang('common_actions');?> <b class="caret"></b>
	            </a>
				  <ul class="dropdown-menu" aria-labelledby="dropdown_actions" style="left:-80px;">
					<li class="dropdown-item"><a href="<?php echo site_url($this->config->item('admin_folder').'/dashboard');?>"><i class="fas fa-home"></i> <?php echo lang('common_dashboard') ?></a></li>
					<li class="dropdown-item"><a href="<?php echo site_url();?>"><i class="fas fa-star"></i> <?php echo lang('common_front_end') ?></a></li>
				    <li class="dropdown-divider"></li>
					<li class="dropdown-item"><a href="<?php echo site_url($this->config->item('admin_folder').'/login/logout');?>"> <i class="fas fa-ban-circle"></i> <?php echo lang('common_log_out') ?></a></li>	
				  </ul>
	          </li>
	        </ul>
	      </div>
	    </nav>

<?php endif;?>