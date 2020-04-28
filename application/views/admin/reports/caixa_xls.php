<?php 
header('Content-type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename=caixa.xls');?>

<table class="table">
    <thead>
		<tr>
			<th>Comentario</th>
			<th>Data</th>
			<th>Metodo</th>
			<th>Valor</th>
			<th>Saldo</th>
	    </tr>
	</thead>
    <tbody>
	<?php echo (count($finances) < 1)?'<tr><td style="text-align:center;" colspan="8">Não há registros a serem mostrados, por favor refine sua busca.</td></tr>':''?>
    <?php foreach($finances as $finance): ?>
	<tr> 
		<td><?php echo $finance->comments; ?></td>
		<td><?php echo sqlToDateTime($finance->datetime); ?></td>
		<td>
		<small>
			<?php if($finance->payment_type == 'credit') { ?>
				<i class="fas fa-plus"></i>
				<?php echo utf8_decode($finance->payment_method);?>
			<?php }else{ ?> 
				<i class="fas fa-minus"></i>
				<?php echo utf8_decode($finance->debit_method);?>
			<?php } ?>
		</small>
		</td>
		<td>
			<small>
				<?php if($finance->payment_type == 'credit') { ?>
					<i class="fas fa-plus"></i>
					<strong style="color:rgb(48, 187, 48);vertical-align: middle;"><?php echo format_currency($finance->amount);?></strong> 
				<?php }else{ ?>
					<strong style="color:red;vertical-align: middle;"><?php echo format_currency(0-$finance->amount);?></strong> 
				<?php } ?> 
			</small>
		</td>
		<td><?php echo format_currency($finance->balance); ?></td>
	</tr>
    <?php endforeach; ?>
    </tbody>
</table>

