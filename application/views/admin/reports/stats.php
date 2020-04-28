<?php $orders = array(); ?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<td>Status</td>
			<td>Janeiro</td>
			<td>Fevereio</td>
			<td>Março</td>
			<td>Abril</td>
			<td>Maio</td>
			<td>Junho</td>
			<td>Julho</td>
			<td>Agosto</td>
			<td>Setembro</td>
			<td>Outubro</td>
			<td>Novembro</td>
			<td>Dezembro</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($status as $key => $s) :?>
			<tr>
				<td><?php echo $s; ?></td>
				<?php 
				for ($i=1; $i <= count($stats[$year]); $i++)
				{
					echo '<td>';
					if (isset($stats[$year][$i][$key]))
					{
						$link = $year.'-'.$i.'-01/'.$year.'-'.$i.'-31/'.str_replace(' ', '_',$key);
						echo '<a href="'.base_url('admin/reports/open_orders/'.$link).'" target="_blank" >';
						echo $stats[$year][$i][$key];
						echo '</a>';

						$orders[$year][$i] +=intval($stats[$year][$i][$key]); 
					}
					echo '</td>';
				} ?>
			</tr>
		<?php endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<td><strong>Total de Pedidos</strong></td>
			<?php 
				for ($i=1; $i <= count($stats[$year]); $i++)
				{
					echo '<td>';
					echo $orders[$year][$i];
					echo '</td>';
				}
			 ?>
		</tr>
	</tfoot>
</table>