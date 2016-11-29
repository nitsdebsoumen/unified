<div class="sitesettings form">
<?php echo $this->Form->create('Setting'); ?>
    <fieldset>
        <legend><?php echo __('Edit Site Setting'); ?></legend>
	<?php
        echo $this->Form->input('hidpw', array('type' => 'hidden', 'value' => $this->request->data['Setting']['id']));
        echo $this->Form->input('id');
        echo $this->Form->input('site_name');
        echo $this->Form->input('paypal_email');
        echo $this->Form->input('site_email');
        echo $this->Form->input('site_url');
        //echo $this->Form->input('bannertext');
        echo $this->Form->input('address');
        echo $this->Form->input('phone');
        echo $this->Form->input('skype');
        echo $this->Form->input('set_commission');
        echo $this->Form->input('featured_provider_vat');
        echo $this->Form->input('featured_course_vat');
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
