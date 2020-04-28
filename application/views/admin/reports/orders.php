<?php $status 		= $this->config->item('order_statuses'); ?>

<ul class="nav nav-tabs" id="Orders_Tab">
<?php foreach ($statuses as $s):?>
	<li <?php echo ($s == 'Shipping SG')? 'class="active"' : ''; ?>>
		<a href="#orders_container" onclick="get_pane('<?php echo md5($s); ?>')"><?php echo $status[$s]; ?></a>
	</li>
<?php endforeach; ?>
</ul>
 
<div class="tab-content">
	<?php foreach ($orders as $key => $items):?>
		<?php $count = 1; $total = 0; ?>
		<div class="tab-pane active" id="<?php echo md5($key) ?>" style="display: none;">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Data</th>
						<th>Pedido</th>
						<th>Item</th>
						<th>Detalhes</th>
						<th>Quantidade</th>
						<th>Valor</th>
						<th>Ações</th>
					</tr>
				</thead>

				<tbody>
				<?php
				foreach($items as $order): ?>
					<tr>
						<td><?php echo $count++; ?></td>
						<td>
							<?php echo str_replace('-','/', format_dmy($order->ordered_on));?>
						</td>
						<td>
							<?php echo $order->order_number; ?>
							<?php if (!empty($order->group_id)) {
								echo ' - MONT: '. $order->group_id;
							} ?>
							<br>
							<?php echo $order->firstname . ' '.$order->lastname ; ?>
						</td>
						<td>
							<?php echo $order->id; ?>
							
						</td>
						<td><?php 
							$prod = unserialize($order->contents);
							//print_helper($prod);
							echo $prod['name'];
							if(!empty($prod['finishing_optional'])) { 
								foreach ($prod['finishing_optional'] as $key => $f)
								{
									echo '<br> '.$f['quantity'].' '.$f['desc'];
								}
							}
							if(!empty($order->name)) { echo '<br>[ '.$order->name.' ]' ; }
						?></td>
						<td><?php echo $order->quantity; ?></td>
						<td style="text-align:right;">
						<?php echo format_currency($order->quantity * $prod['price']); ?>
						<?php $total +=($order->quantity * $prod['price']); ?>
						<?php 
						if($order->finishing_price >0)
						{
							echo '<br>+'. format_currency($order->finishing_price); 
							$total +=$order->finishing_price;
						}
						if($order->coupon_discount >0)
						{
							$ds = ($order->coupon_discount / ($order->subtotal/100));
							$ds_sub = ($order->quantity * $prod['price'] /100)*$ds;
							echo '<br>-'. format_currency(($ds_sub));
							$total -= $ds_sub;
						}
						?>
						</td>
						<td  style="text-align:left; padding-left:10px;" >
							<div class="btn-group">							
								<a target="_blank" title="Visualizar" rel="tooltip" class="btn btn-primary" href="<?php echo base_url('admin/orders/view_order/'.$order->order_id);?>">
									<i class="fas fa-search"></i>
								</a>
							<?php if (!empty($order->shipping_id)):?>
							    <div class="btn-group">
							      <a class="btn dropdown-toggle " rel="tooltip" data-toggle="dropdown" title="Fatura" rel="tooltip" href="#">
							        	<i class="fas fa-list-alt"></i>
							        <span class="caret"></span>
							      </a>
							      <ul class="dropdown-menu">
							        	<li>
									        <a target="_blank" href="<?php echo base_url('admin/billing/packing_slip_master/'.$order->shipping_id);?>">
												Fatura de entrega
											</a>
								        </li>
								        <li>
									        <a target="_blank" href="<?php echo base_url('admin/billing/print_shipping_details/'.$order->shipping_id);?>">
												Cupon de entrega
											</a>
								        </li>
							      </ul>
							    </div>
							<?php else :  ?>
							    <a target="_blank" title="Fatura" rel="tooltip" class="btn btn-primary" href="<?php echo base_url('admin/orders/packing_slip/'.$order->order_id);?>">
									<icon class="fas fa-list-alt"></icon>
								</a>
							<?php endif ?>
								<button title="Histórico" rel="tooltip" class="btn btn-primary" onclick="get_history(<?php echo $order->id; ?>)" >
									<icon class="fas fa-refresh"></icon>
								</button>							
							</div>
						</td>			
					</tr>		
				<?php endforeach;?>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><?php echo format_currency($total); ?></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
	<?php endforeach; ?>
</div>

<script>
	function get_pane(id)
	{
		$('#orders_container .tab-pane').hide();
		$('#'+id).show();
	}
	
	$(function () {
		$('#Orders_Tab a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		});
		$('#Orders_Tab a').first().click();
	});
</script>