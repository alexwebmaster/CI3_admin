<?php $admin_url = site_url($this->config->item('admin_folder')).'/';?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo $admin_url;?>dashboard">
        
        <img class="mx-4 w-75" src="<?php echo base_url('assets/img/logo.png');?>" alt="Coletivo Aprendiz">
    </a>

    <?php
    // Restrict access to Admins only
    if($this->auth->check_access('Admin')) : ?>

    <!-- Divider -->
  	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span><?php echo lang('common_content') ?></span>
        </a>
        <div id="collapsePages" class="collapse" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo $admin_url;?>pages"><?php echo lang('common_pages') ?></a>
            <a class="collapse-item" href="<?php echo $admin_url;?>banners"><?php echo lang('common_banners') ?></a>
          </div>
        </div>
    </li>

  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
      <a class="nav-link collapsed" href="<?php echo $admin_url;?>categories"  >
        <i class="fas fa-fw fa-folder"></i>
        <span><?php echo lang('common_categories') ?></span>
      </a>
  </li>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseAdmin">
          <i class="fas fa-fw fa-folder"></i>
          <span><?php echo lang('common_administrative') ?></span>
        </a>
        <div id="collapseAdmin" class="collapse" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo $admin_url;?>admin"><?php echo lang('common_administrators') ?></a>
            <a class="collapse-item" href="<?php echo $admin_url;?>settings"><?php echo lang('common_cart_configuration') ?></a>
            <a class="collapse-item" href="<?php echo $admin_url;?>locations"><?php echo lang('common_locations') ?></a>
          </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
          <span><?php echo lang('common_log_out') ?></span></a>
    </li>

  	<!-- Sidebar Toggler (Sidebar) -->
  	<div class="text-center">
  		<button class="rounded-circle border-0" id="sidebarToggle"></button>
  	</div>

    <?php endif; ?>
</ul>