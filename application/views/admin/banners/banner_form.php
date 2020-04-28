<?php
$name			= array('name'=>'name', 'value' => set_value('name', $name), 'class' => 'form-control');
$enable_date	= array('name'=>'enable_date', 'id'=>'enable_date', 'value'=>set_value('enable_on', set_value('enable_date', $enable_date)), 'class' => 'form-control' );
$disable_date	= array('name'=>'disable_date', 'id'=>'disable_date', 'value'=>set_value('disable_on', set_value('disable_date', $disable_date)), 'class' => 'form-control');
$f_image		= array('name'=>'image', 'id'=>'image');
$link			= array('name'=>'link', 'value' => set_value('link', $link), 'class' => 'form-control');
$new_window		= array('name'=>'new_window', 'value'=>1, 'checked'=>set_checkbox('new_window', 1, $new_window));
?>
<div class="col col-6">
	
	<?php echo form_open_multipart(config_item('admin_folder').'/banners/banner_form/'.$banner_collection_id.'/'.$banner_id); ?>
		<div class="form-group">
			<label for="name"><?php echo lang('name');?> </label>
			<?php echo form_input($name); ?>
		</div>

		<div class="form-group">
			<label for="link"><?php echo lang('link');?> </label>
			<?php echo form_input($link); ?>
		</div>

		<div class="form-group">
			<label class="checkbox">
			    <?php echo form_checkbox($new_window); ?> <?php echo lang('new_window');?>
			</label>
		</div>

		<div class="form-group">
			<label for="category_id">
			Categoria
			</label>
			<?php
				function list_categories($id, $categories, $sub='', $selected = 0) {

					foreach ($categories[$id] as $cat):?>
					<option class="" value="<?php echo $cat->id;?>" <?php echo ($selected == $cat->id) ? ' selected="selected" ' : '';?> ><?php echo  $sub.$cat->name; ?></option>
					<?php
					if (isset($categories[$cat->id]) && sizeof($categories[$cat->id]) > 0)
					{
						$sub2 = str_replace('&rarr;&nbsp;', '&nbsp;', $sub);
						$sub2 .=  '&nbsp;&nbsp;&nbsp;&rarr;&nbsp;';
						list_categories($cat->id, $categories, $sub2, $selected);
					}
					endforeach;
				}

				if(!empty($categories))
				{
					echo '<select name="category_id" class="form-control">';
					echo '<option value="">Selecione</option>';
					list_categories(0, $categories, '', $category_id);
					echo '</select>';

				}
			?>
		</div>

		<div class="form-group">
			<label for="enable_date"><?php echo lang('enable_date');?> </label>
			<?php echo form_input($enable_date); ?>
		</div>

		<div class="form-group">
			<label for="disable_date"><?php echo lang('disable_date');?> </label>
			<?php echo form_input($disable_date); ?>
		</div>

		<div class="form-group">
			<label for="image"><?php echo lang('image');?> </label>
			<?php echo form_upload($f_image); ?>
		</div>

		<div class="form-group">
			<?php if($banner_id && $image != ''):?>
			<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img src="<?php echo base_url('uploads/'.$image);?>" alt="current"/><br/><?php echo lang('current_file');?></div>
			<?php endif;?>
		</div>

		<div class="form-actions mb-3">
			<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#enable_date").datepicker({ dateFormat: 'mm-dd-yy'});
		$("#disable_date").datepicker({ dateFormat: 'mm-dd-yy'});
	});

	$('form').submit(function() {
		$('.btn').attr('disabled', true).addClass('disabled');
	});
</script>
