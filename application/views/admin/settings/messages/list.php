<div class="button_set float-right">
    <a class="btn btn-primary" href="<?php echo site_url($this->config->item('admin_folder').'/settings/canned_message_form/');?>"><i class="fas fa-plus"></i> <?php echo lang('add_canned_message');?></a>
</div>          

<?php if(count($canned_messages) > 0): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th><?php echo lang('message_name');?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($canned_messages as $message): ?>
        <tr class="gc_row">
            <td><?php echo $message['name']; ?></td>
            <td>
                <span class="btn-group float-right">
                    <a class="btn btn-primary" href="<?php echo site_url($this->config->item('admin_folder').'/settings/canned_message_form/'.$message['id']);?>"><i class="fas fa-pencil-alt"></i> <?php echo lang('edit');?></a>
                    <?php if($message['deletable'] == 1) : ?>   
                        <a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/settings/delete_message/'.$message['id']);?>" onclick="return areyousure();"><i class="fas fa-trash "></i> <?php echo lang('delete');?></a>
                    <?php endif; ?>
                </span>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_are_you_sure');?>');
}
</script>