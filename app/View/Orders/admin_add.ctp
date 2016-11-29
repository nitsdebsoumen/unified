<!-- <div class="shippingAddresses form">
<?php echo $this->Form->create('ShippingAddress'); ?>
	<fieldset>
		<legend><?php echo __('Add Shipping Address'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('full_name');
		echo $this->Form->input('street');
		echo $this->Form->input('apartment');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip_code');
		echo $this->Form->input('country');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Shipping Addresses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div> -->


<div class="venue form">
<?php echo $this->Form->create('Order',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add Order'); ?></legend>
	<?php
        echo $this->Form->input('user_id');
        echo $this->Form->input('post_id');
        //echo $this->Form->input('event_id');
        //echo $this->Form->input('venue_name');
        echo $this->Form->input('quantity',array('type'=>'number'));
        echo $this->Form->input('order_date');
        echo $this->Form->input('transaction_id',array('type'=>'text'));
        echo $this->Form->input('payment_date');
        //echo $this->Form->input('sort_of_details');
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>