<div class="categories form">
<?php echo $this->Form->create('Sale',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Add Sale'); ?></legend>
	<?php
		echo $this->Form->input('user_id',array('empty' => '(choose any user)'));
		echo $this->Form->input('membershipplans',array('empty' => '(choose any membership plan)'));
		echo $this->Form->input('renew');
		echo $this->Form->input('payment_method');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>