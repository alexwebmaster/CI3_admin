<table class="table table-striped" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('sku');?></th>
			<th><?php echo lang('name');?></th>
			<th><?php echo lang('quantity');?></th>
			<th><?php echo lang('total');?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($best_sellers as $b):?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php echo  $b->sku; ?></td>
			<td><?php echo  empty($b->name)? 'Produto Deletado': $b->name; ?></td>
			<td><?php echo  $b->quantity; ?></a></td>
			<td><?php echo  format_currency($b->total); ?></a></td>
			<?php $total_sales +=$b->total; ?>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>