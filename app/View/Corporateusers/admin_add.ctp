<div class="users form">
<?php echo $this->Form->create('User',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
	<?php
        
        echo $this->Form->input('first_name');
        echo $this->Form->input('last_name');
        echo $this->Form->input('email_address', array('type' => 'email'));
        echo $this->Form->input('user_pass', array('type' => 'password'));
        echo $this->Form->input('Address1');
        echo $this->Form->input('state');
        echo $this->Form->input('city');
        echo $this->Form->input('zip');
        echo $this->Form->input('country_id');
        echo $this->Form->input('Phone_number');
        //echo $this->Form->input('has_marketplace');
        echo $this->Form->input('status');
        echo $this->Form->input('image',array('type'=>'file'));
        echo $this->Form->input('admin_type', array('type' => 'hidden', 'value' => 3));
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>