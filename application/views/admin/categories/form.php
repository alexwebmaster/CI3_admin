<?php echo form_open_multipart($this->config->item('admin_folder').'/categories/form/'.$id); ?>
<?php $options = array('0' => 'Não', '1' => 'Sim'); ?>
<div class="tabbable">

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item active"><a href="#description_tab" class="nav-link" role="tab" data-toggle="tab"><?php echo lang('description');?></a></li>
		<li class="nav-item"><a class="nav-link" role="tab" href="#attributes_tab" data-toggle="tab"><?php echo lang('attributes');?></a></li>
		<li class="nav-item"><a class="nav-link" role="tab" href="#seo_tab" data-toggle="tab"><?php echo lang('seo');?></a></li>
		<li class="nav-item">
			<a class="nav-link" role="tab" href="#fields_tab" data-toggle="tab">Campos</a>
		</li>
	</ul>

	<div class="tab-content mt-3">

		<div class="tab-pane active" id="description_tab">
			
			<fieldset>
				<div class="form-group">
					<label for="name"><?php echo lang('name');?></label>
					<?php
					$data	= array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'form-control');
					echo form_input($data);
					?>					
				</div>
				
				<div class="form-group">
					<label for="description"><?php echo lang('description');?></label>
					<textarea name="description" class="redactor"><?php echo $description;?></textarea>
				</div>

				<div class="form-row">
					<div class="col">
						<label for="qualified">Exige Comprador Qualificado</label><br>
		        		<?php echo form_dropdown('qualified', array('0' => 'Não', '1' => 'Sim'), set_value('qualified',$qualified), 'class="custom-select"'); ?>
					</div>
					<div class="col">
						<label for="show_categories">Mostrar categorias em:</label><br>
		        		<?php echo form_dropdown('show_categories', array('list' => 'Lista', 'grid' => 'Grade'), set_value('show_categories',$show_categories), 'class="custom-select"'); ?>
					</div>
					<div class="col">
						<label for="show_description">Mostrar descrição:</label><br>
		        		<?php echo form_dropdown('show_description', array('0' => 'Não', '1' => 'Sim'), set_value('show_description',$show_description), 'class="custom-select"'); ?>
					</div>
					<div class="col">
						<label for="enabled"><?php echo lang('enabled');?> </label><br>
		        		<?php echo form_dropdown('enabled', array('0' => lang('disabled'), '1' => lang('enabled')), set_value('enabled',$enabled), 'class="custom-select"'); ?>
					</div>
				</div>

			</fieldset>
		</div>

		<div class="tab-pane" id="attributes_tab">
			
			<fieldset >
				<div class="form-group">
					<label for="slug"><?php echo lang('slug');?> </label>
					<?php
					$data	= array('name'=>'slug', 'value'=>set_value('slug', $slug), 'class'=>'form-control');
					echo form_input($data);
					?>					
				</div>
				
				<div class="form-group">
					<label for="sequence"><?php echo lang('sequence');?> </label>
					<?php
					$data	= array('name'=>'sequence', 'value'=>set_value('sequence', $sequence), 'class'=>'form-control');
					echo form_input($data);
					?>
				</div>
				
				<div class="form-group">
					<label for="parent_id"><?php echo lang('parent');?> </label>
					<?php
					$data	= array(0 => lang('top_level_category'));
					foreach($categories as $parent)
					{
						if($parent->id != $id)
						{
							$data[$parent->id] = $parent->name;
						}
					}
					echo form_dropdown('parent_id', $data, $parent_id, 'class="custom-select"');
					?>
				</div>
				
				<div class="form-group">
					<label for="excerpt"><?php echo lang('excerpt');?> </label>
					<?php
					$data	= array('name'=>'excerpt', 'value'=>set_value('excerpt', $excerpt), 'class'=>'form-control', 'rows'=>3);
					echo form_textarea($data);
					?>
				</div>

				<div class="form-group">
					<label for="image"><?php echo lang('image');?> </label>
					<div class="input-append">
						<?php echo form_upload(array('name'=>'image'));?><span class="add-on"><?php echo lang('max_file_size');?> <?php echo  $this->config->item('size_limit')/1024; ?>kb</span>
					</div>
				</div>
					
				<?php if($id && $image != ''):?>
				
				<div style="text-align:center; padding:5px; border:1px solid #ddd;"><img src="<?php echo base_url('uploads/images/small/'.$image);?>" alt="current"/><br/><?php echo lang('current_file');?></div>
				
				<?php endif;?>
				
			</fieldset>	
		</div>
		
		<div class="tab-pane" id="seo_tab">
			<fieldset>
				<div class="form-group">
					<label for="seo_title"><?php echo lang('seo_title');?> </label>
					<?php
					$data	= array('name'=>'seo_title', 'value'=>set_value('seo_title', $seo_title), 'class'=>'form-control');
					echo form_input($data);
					?>
				</div>

				<div class="form-group">
					<label><?php echo lang('meta');?></label> 
					<?php
					$data	= array('rows'=>3, 'name'=>'meta', 'value'=>set_value('meta', html_entity_decode($meta)), 'class'=>'form-control');
					echo form_textarea($data);
					?>
				</div>
				<p class="help-block"><?php echo lang('meta_data_description');?></p>
			</fieldset>
		</div>

		<div class="tab-pane" id="fields_tab">
			<table class="table table-condensed table-bordered">
				<tr>
					<th>Ordem</th>
					<th>Nome de campo</th>
					<th>Mostrar na tabela</th>
					<th>filtro</th>
					<th>Tipo</th>
				</tr>
			<tbody id="fields_sortable">
				<?php foreach ($fields as $key => $f):?>
					<tr id="field-<?php echo $f['order'];?>" class="<?php echo ($f['display']==0)? '':'table-success';?>">
						<td class="handle" style="width: 40px;">
							<input type="hidden" class="order_id" name="order[]" value="<?php echo $f['order'] ?>">
							<input type="hidden" name="table[]" value="<?php echo $f['table'] ?>">
							<input type="hidden" name="join[]" value="<?php echo $f['join'] ?>">
							<input type="hidden" name="sql[]" value="<?php echo $f['sql'] ?>">
							<input type="hidden" name="select[]" value="<?php echo $f['select'] ?>">
							<input type="hidden" name="reference[]" value="<?php echo $f['reference'] ?>">
							<a class="btn btn-outline-secondary" style="cursor:move"><i class="fas fa-indent"></i></a>
						</td>
						<td>
							<input type="text" name="title[]" value="<?php echo $f['title'] ?>" class="form-control" />
							<input type="hidden" name="field[]" value="<?php echo $f['field'] ?>">
						</td>
						<td>
							<?php echo form_dropdown('display[]', array('0' => 'Não', '1' => 'Sim'), set_value('display',$f['display']), 'class="custom-select"'); ?>
						</td>
						<td><?php echo form_dropdown('filter[]', $options, set_value('filter',$f['filter']), 'class="custom-select"'); ?></td>
						<td><?php echo form_dropdown('type[]', $field_types, set_value('type',$f['type']), 'class="custom-select"'); ?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
			</table>
		</div>
	</div>
</div>
<hr>
<div class="form-actions">
	<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js');?>"></script>
<script type="text/javascript">
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});
</script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	create_sortable();	
});
// Return a helper with preserved width of cells
var fixHelper = function(e, ui) {
	ui.children().each(function() {
		$(this).width($(this).width());
	});
	return ui;
};
function create_sortable()
{
	$('#fields_sortable').sortable({
		scroll: true,
		helper: fixHelper,
		axis: 'y',
		handle:'.handle',
		update: function(){
			save_sortable();
		}
	});	
	$('#fields_sortable').sortable('enable');
}

function save_sortable()
{
	$('.order_id').each(function(index){
		$(this).val(index);
	});
}
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_banner');?>');
}
//]]>
</script>