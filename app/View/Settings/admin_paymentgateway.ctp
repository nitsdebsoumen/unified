<div class="sitesettings form">
<?php echo $this->Form->create('SiteSetting'); ?>
	<fieldset>
		<legend><?php echo __('Edit Paypal Payment Gateway'); ?></legend>
	<?php
            echo $this->Form->input('id');
        ?>
            <div class="input select">
                <label for="SiteSettingPaypalMode">Paypal Mode</label>
                <select id="SiteSettingPaypalMode" name="data[SiteSetting][paypal_mode]"> 
                    <option value="0" <?php echo (isset($this->request->data['SiteSetting']['paypal_mode']) && $this->request->data['SiteSetting']['paypal_mode']==0)?'selected="selected"':'';?>>Sandbox</option>
                    <option value="1" <?php echo (isset($this->request->data['SiteSetting']['paypal_mode']) && $this->request->data['SiteSetting']['paypal_mode']==1)?'selected="selected"':'';?>>Live</option>
                </select>
            </div>    
                
        <?php    
            echo $this->Form->input('paypal_email');
            echo $this->Form->input('paypal_developer_email');
            echo $this->Form->input('paypal_app_id', array('type'=>'text', 'label'=> 'Paypal App ID'));
            echo $this->Form->input('api_username');
            echo $this->Form->input('api_password');
            echo $this->Form->input('api_signature');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
