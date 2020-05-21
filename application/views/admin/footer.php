
        </div>
      </div>

		</div>
	</div>

	<!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo lang('common_logout_header') ?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><?php echo lang('common_logout_message') ?></div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo lang('common_cancel') ?></button>
          <a class="btn btn-primary" href="<?php echo site_url($this->config->item('admin_folder').'/login/logout');?>"><?php echo lang('common_log_out') ?></a>
        </div>
      </div>
    </div>
  </div>

</body>
</html>