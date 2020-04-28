<?php if(count($shipping_modules) >0): ?>
	<table class="table table-striped">
		<tbody>
		<?php foreach($shipping_modules as $module=>$enabled): ?>
			<tr>
				<td><?php echo humanize($module); ?></td>
				<td>
					<span class="btn-group float-right">
				<?php if($enabled): ?>
					<a class="btn btn-primary" href="<?php echo site_url($this->config->item('admin_folder').'/shipping/settings/'.$module);?>"><i class="fas fa-wrench"></i> <?php echo lang('settings');?></a>
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/shipping/uninstall/'.$module);?>" onclick="return areyousure();"><i class=" icon-minus "></i> <?php echo lang('uninstall');?></a>
				<?php else: ?>
					<a class="btn btn-primary" href="<?php echo site_url($this->config->item('admin_folder').'/shipping/install/'.$module);?>"><i class="fas fa-ok"></i> <?php echo lang('install');?></a>
				<?php endif; ?>
					</span>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>