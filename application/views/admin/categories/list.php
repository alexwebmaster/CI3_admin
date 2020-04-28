<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_category');?>');
}
</script>

<div style="text-align:right">
	<a class="btn btn-primary" href="<?php echo site_url($this->config->item('admin_folder').'/categories/form'); ?>"><i class="fas fa-plus"></i> <?php echo lang('add_new_category');?></a>
</div>

<table class="table table-striped mt-3">
    <thead>
		<tr>
			<th></th>
			<th><?php echo lang('category_id');?></th>
			<th><?php echo lang('name')?></th>
			<th><?php echo lang('enabled');?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php echo (count($categories) < 1)?'<tr><td style="text-align:center;" colspan="4">'.lang('no_categories').'</td></tr>':''?>
		<?php
		define('ADMIN_FOLDER', $this->config->item('admin_folder'));
		function list_categories($parent_id, $cats, $sub='') {
			
			foreach ($cats[$parent_id] as $cat):?>
			<tr <?php echo ($parent_id) ? 'class="tr_'.$parent_id.'" style="display:none;"': '' ?>>
				<td>
					<?php if (!$parent_id) {?>
					 	<button class="btn btn-primary btn-sm tg_icon" data-target=".<?php echo 'tr_'.$cat->id ?>"> <i class="fas fa-plus"></i></button>
					<?php } ?>
				</td>
				<td><?php echo  $cat->id; ?></td>
				<td><?php echo  $sub.$cat->name; ?></td>
				<td>
					<?php if($cat->enabled == '1') :?>
						<i class="fas fa-check"></i>
					<?php else : ?>
						<i class="fas fa-ban"></i>
					<?php endif ?>
				</td>
				<td>
					<div class="btn-group" style="float:right">

						<a class="btn btn-info" href="<?php echo  site_url(ADMIN_FOLDER.'/categories/form/?parent_id='.$cat->id);?>"><i class="fas fa-folder-plus"></i></a>
						
						<a class="btn btn-primary" href="<?php echo  site_url(ADMIN_FOLDER.'/categories/form/'.$cat->id);?>"><i class="fas fa-pencil-alt"></i> <?php echo lang('edit');?></a>
						
						<a class="btn btn-danger" href="<?php echo  site_url(ADMIN_FOLDER.'/categories/delete/'.$cat->id);?>" onclick="return areyousure();"><i class="fas fa-trash"></i> <?php echo lang('delete');?></a>
					</div>
				</td>
			</tr>
			<?php
			if (isset($cats[$cat->id]) && sizeof($cats[$cat->id]) > 0)
			{
				$sub2 = str_replace('&rarr;&nbsp;', '&nbsp;', $sub);
				$sub2 .=  '&nbsp;&nbsp;&nbsp;&rarr;&nbsp;';
				list_categories($cat->id, $cats, $sub2);
			}
			endforeach;
		}
		
		if(isset($categories[0]))
		{
			list_categories(0, $categories);
		}
		
		?>
	</tbody>
</table>
<script type="text/javascript">
	$('.tg_icon').click(function(){
		var target = $(this).data('target');
	    var icon = $(this).find('i');

	    console.log(target);

	    if (icon.hasClass('fa-plus')) {
	      icon.removeClass('fa-plus').addClass('fa-minus');
	      $(target).show();
	    } else {
	      icon.removeClass('fa-minus').addClass('fa-plus');
	      $(target).hide();
	    }
    });
</script>