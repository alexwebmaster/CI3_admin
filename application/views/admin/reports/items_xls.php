<?php 
header('Content-type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename=items.xls');

//status
$colors 		= $this->config->item('order_statuses_colors');
$status 		= $this->config->item('order_statuses');
$order_status 	= $status;	
$order_status_array = array_merge(array(0=> 'Todos'), $order_status);
?>

<table>
	<thead>
		<tr>
			<th>Status</th>
			<th>Data do Pedido</th>
			<th>Numero do Pedido</th>
			<th>Montagem</th>
			<th>Entrega</th>
			<th>Cliente</th>
			<th>Item</th>
			<th>Detalhes </th>
			<th>Acabamento</th>
			<th>Quantidade </th>
			<th>Valor </th>
			<th>Valor Acabamento</th>
		</tr>
	</thead>

	<tbody>
	<?php
	foreach($orders as $order): ?>
		<tr>
			<td style="background-color:<?php echo $colors[$order->status] ?>;">
				<?php echo utf8_decode($order_status[$order->status]); ?>
			</td>
			<td>
				<?php echo sqlToDateTime($order->ordered_on);?>
			</td>
			<td>
				<?php echo $order->order_number; ?>
			</td>
			<td>
				<?php echo $order->group_id; ?>
			</td>
			<td>
				<?php echo $order->delivery_id; ?>
			</td>
			<td>
				<?php echo utf8_decode($order->firstname . ' '.$order->lastname) ; ?>				
			</td>
			<td>
				<?php echo $order->id; ?>
			</td>
			<td>
			<?php 
				$prod = unserialize($order->contents);
				echo utf8_decode($prod['name']);
			?>
			</td>
			<td>
			<?php 
				if(!empty($prod['finishing_optional'])) { 
					foreach ($prod['finishing_optional'] as $key => $f)
					{
						echo $f['quantity'].' '.$f['desc'];
					}
				} ?>
			</td>
			<td><?php echo $order->quantity; ?></td>
			<td style="text-align:right;">
			<?php

			$price = ($order->quantity * $prod['price']);

			if($order->coupon_discount >0)
			{
				$ds = ($order->coupon_discount / ($order->subtotal/100));
				$ds_sub = ($price /100)*$ds;
				$price = $price-$ds_sub;
			}
				echo format_currency($price);
			?>
			</td>
			<td>
				<?php if($order->finishing_price >0) { echo format_currency($order->finishing_price); } ?>
			</td>
		</tr>		
	<?php endforeach;?>
	</tbody>
</table>