<?php echo form_open_multipart(config_item('admin_folder').'/settings');?>

<fieldset>
    <legend><?php echo lang('shop_details');?></legend>
    <div class="row">
        <div class="col-4">
            <label><?php echo lang('company_name');?></label>
            <?php echo form_input(array('class'=>'form-control', 'name'=>'company_name', 'value'=>set_value('company_name', $company_name)));?>
        </div>

        <div class="col-4">
            <label><?php echo lang('theme');?></label><br>
            <?php echo form_dropdown('theme', $themes, set_value('theme', $theme), 'class="custom-select"');?>
        </div>

        <div class="col-4">
            <label><?php echo lang('cart_email');?></label>
            <?php echo form_input(array('class'=>'form-control', 'name'=>'email', 'value'=>set_value('email', $email)));?>
        </div>        
    </div>
</fieldset>

<fieldset>
    <legend><?php echo lang('ship_from_address');?></legend>

    <label><?php echo lang('country');?></label>
    <?php echo form_dropdown('country_id', $countries_menu, set_value('country_id', $country_id), 'id="country_id" class="col-12 custom-select"');?>

    <div class="row">
        <div class="col-6">
            <label><?php echo lang('address1');?></label>
            <?php echo form_input(array('name'=>'address1', 'class'=>'form-control col-12','value'=>set_value('address1',$address1)));?>
        </div>
        <div class="col-6">
            <label><?php echo lang('address2');?></label>
            <?php echo form_input(array('name'=>'address2', 'class'=>'form-control col-12','value'=> set_value('address2',$address2)));?>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <label><?php echo lang('city');?></label>
            <?php echo form_input(array('name'=>'city','class'=>'form-control', 'value'=>set_value('city',$city)));?>
        </div>
        <div class="col-6">
            <label><?php echo lang('state');?></label><br>
            <?php echo form_dropdown('zone_id', $zones_menu, set_value('zone_id', $zone_id), 'id="zone_id" class="custom-select"');?>
        </div>
        <div class="col-2">
            <label><?php echo lang('zip');?></label>
            <?php echo form_input(array('maxlength'=>'10', 'class'=>'form-control', 'name'=>'zip', 'value'=> set_value('zip',$zip)));?>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><?php echo lang('locale_currency');?></legend>

    <div class="row">
        <div class="col-6">
            <label><?php echo lang('locale');?></label><br>
            <?php echo form_dropdown('locale', $locales, set_value('locale', $locale), 'class="custom-select"');?>
        </div>
        <div class="col-6">
            <label><?php echo lang('currency');?></label><br>
            <?php echo form_dropdown('currency_iso', $iso_4217, set_value('currency_iso', $currency_iso), 'class="custom-select"');?>
        </div>
        
    </div>

</fieldset>

<fieldset>
    <legend><?php echo lang('security');?></legend>

    <div class="form-group">
        <label class="text-capitalize"><?php echo lang('admin_folder');?></label>
        <?php echo form_input(array('name'=>'admin_folder', 'class'=>'form-control col-12','value'=>set_value('admin_folder',$admin_folder)));?>
    </div>

    <div class="form-row">
        <label class="checkbox">
            <?php echo form_checkbox('ssl_support', '1', set_value('ssl_support',$ssl_support));?> <?php echo lang('ssl_support');?>
        </label>
    </div>

</fieldset>

<fieldset class="mb-3">
    <legend><?php echo lang('package_details');?></legend>

    <div class="row">
        <div class="col-6">
            <label><?php echo lang('weight_unit');?></label>
            <?php echo form_input(array('name'=>'weight_unit', 'class'=>'form-control','value'=>set_value('weight_unit',$weight_unit)));?>    
        </div>
        <div class="col-6">
            <label><?php echo lang('dimension_unit');?></label>
            <?php echo form_input(array('name'=>'dimension_unit', 'class'=>'form-control','value'=>set_value('dimension_unit',$dimension_unit)));?>
        </div>
    </div>
</fieldset>

<input type="submit" class="btn btn-primary" value="<?php echo lang('save');?>" />

</form>