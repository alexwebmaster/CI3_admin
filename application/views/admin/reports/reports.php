<style type="text/css">
	#best_sellers, .tab-content
	{
		max-height: 400px;
	    overflow-x: auto;
	    margin-bottom: 30px;
	    border: 1px solid #ddd;
	}
</style>
<div class="row">
	<div class="col-6">
		<h3><?php echo lang('best_sellers');?></h3>
	</div>
	<div class="col-6">
		<form class="form-inline float-right justify-content-end">
			<input class="form-control col-2" type="text"  id="best_sellers_start" placeholder="<?php echo lang('from');?>"/>
			<input type="hidden" name="best_sellers_start" id="best_sellers_start_alt" /> 
			<input class="form-control col-2" type="text" id="best_sellers_end" placeholder="<?php echo lang('to');?>"/>
			<input type="hidden" name="best_sellers_end" id="best_sellers_end_alt" /> 
			
			<input class="btn btn-primary" type="button" value="<?php echo lang('get_best_sellers');?>" onclick="get_best_sellers()"/>
		</form>
	</div>
</div>


<div class="row">
	<div class="col-12" id="best_sellers" ></div>
</div>


<div class="row">
	<div class="col-6">
		<h3><?php echo lang('sales');?></h3>
	</div>
	<div class="col-6">
		<form class="form-inline float-right justify-content-end">
			<select class="custom-select col name="year" id="sales_year">
				<?php foreach($years as $y):?>
					<option value="<?php echo $y;?>"><?php echo $y;?></option>
				<?php endforeach;?>
			</select>
			<input class="btn btn-primary" type="button" value="<?php echo lang('get_monthly_sales');?>" onclick="get_monthly_sales()"/>
		</form>
	</div>
</div>

<div class="row">
	<div class="col-12" id="sales_container"></div>
</div>

<div class="row">
	<div class="col-6">
		<h3>Relatório de pedidos</h3>
	</div>
	<div class="col-6">
		<form class="form-inline float-right justify-content-end">
			<select class="custom-select col name="year" id="stats_year">
				<?php foreach($years as $y):?>
					<option value="<?php echo $y;?>"><?php echo $y;?></option>
				<?php endforeach;?>
			</select>
			<input class="btn btn-primary" type="button" value="Obter" onclick="get_stats()"/>
		</form>
	</div>
</div>

<div class="row">
	<div class="col-12" id="stats_container"></div>
</div>

<div class="row" style="margin-top: 30px;">
	<div class="col-4"><h3>Pedidos</h3> </div>
	<div class="col-8">
		<form class="form-inline float-right justify-content-end">
			<input class="form-control col-2" type="text" id="term" name="search" placeholder="<?php echo lang('search');?>" />
			<input class="form-control col-2" type="text"  id="orders_start" placeholder="<?php echo lang('from');?>"/>
			<input type="hidden" name="orders_start" id="orders_start_alt" /> 
			<input class="form-control col-2" type="text" id="orders_end" placeholder="<?php echo lang('to');?>"/>
			<input type="hidden" name="orders_end" id="orders_end_alt" /> 
			
			<input class="btn btn-primary" type="button" value="Obter" onclick="get_orders()"/>
		</form>
	</div>
	<div class="col-12" id="orders_container"></div>
</div>

<div class="row" style="margin-top: 30px;">
	<div class="col-4"><h3>Entregas</h3> </div>
	<div class="col-8">
		<form class="form-inline float-right justify-content-end">
			<input class="form-control col-2" type="text" id="deliveries_term" name="search" placeholder="<?php echo lang('search');?>" />
			<input class="form-control col-2" type="text"  id="deliveries_start" placeholder="<?php echo lang('from');?>"/>
			<input type="hidden" name="deliveries_start" id="deliveries_start_alt" /> 
			<input class="form-control col-2" type="text" id="deliveries_end" placeholder="<?php echo lang('to');?>"/>
			<input type="hidden" name="deliveries_end" id="deliveries_end_alt" /> 
			
			<input class="btn btn-primary" type="button" value="Obter" onclick="get_deliveries()"/>
		</form>
	</div>
	<div class="col-12" id="deliveries_container"></div>
</div>


<script type="text/javascript">

$(document).ready(function(){
	get_best_sellers();
	get_monthly_sales();
	get_orders();
	get_stats();
	get_deliveries();
	$('input:button').button();
	$('#best_sellers_start').datepicker({ dateFormat: 'mm-dd-yy', altField: '#best_sellers_start_alt', altFormat: 'yy-mm-dd' });
	$('#best_sellers_end').datepicker({ dateFormat: 'mm-dd-yy', altField: '#best_sellers_end_alt', altFormat: 'yy-mm-dd' });
	$('#orders_start').datepicker({ dateFormat: 'mm-dd-yy', altField: '#orders_start_alt', altFormat: 'yy-mm-dd' });
	$('#orders_end').datepicker({ dateFormat: 'mm-dd-yy', altField: '#orders_end_alt', altFormat: 'yy-mm-dd' });
	$('#deliveries_start').datepicker({ dateFormat: 'mm-dd-yy', altField: '#deliveries_start_alt', altFormat: 'yy-mm-dd' });
	$('#deliveries_end').datepicker({ dateFormat: 'mm-dd-yy', altField: '#deliveries_end_alt', altFormat: 'yy-mm-dd' });
});

function get_best_sellers()
{
	show_animation();
	$.post('<?php echo site_url($this->config->item('admin_folder').'/reports/best_sellers');?>',{start:$('#best_sellers_start_alt').val(), end:$('#best_sellers_end_alt').val()}, function(data){
		$('#best_sellers').html(data);
		setTimeout('hide_animation()', 500);
	});
}

function get_monthly_sales()
{
	show_animation();
	$.post('<?php echo site_url($this->config->item('admin_folder').'/reports/sales');?>',{year:$('#sales_year').val()}, function(data){
		$('#sales_container').html(data);
		setTimeout('hide_animation()', 500);
	});
}

function get_stats()
{
	show_animation();
	$.post('<?php echo site_url($this->config->item('admin_folder').'/reports/stats');?>',{year:$('#stats_year').val()}, function(data){
		$('#stats_container').html(data);
		setTimeout('hide_animation()', 500);
	});
}
function get_orders()
{
	show_animation();
	var postdata = 
	{ 
		year:$('#sales_year').val(), 
		start:$('#orders_start_alt').val(), 
		end:$('#orders_end_alt').val(),
		term:$('#term').val()
	};
	$.post('<?php echo site_url($this->config->item('admin_folder').'/reports/orders');?>',postdata, function(data){
		$('#orders_container').html(data);
		setTimeout('hide_animation()', 500);
	});
}
function get_deliveries()
{
	show_animation();
	var postdata = 
	{ 
		year:$('#sales_year').val(), 
		start:$('#deliveries_start_alt').val(), 
		end:$('#deliveries_end_alt').val(),
		term:$('#deliveries_term').val()
	};
	$.post('<?php echo site_url($this->config->item('admin_folder').'/reports/deliveries');?>',postdata, function(data){
		$('#deliveries_container').html(data);
		setTimeout('hide_animation()', 500);
	});
}
</script>