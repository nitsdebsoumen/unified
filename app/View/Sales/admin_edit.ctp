<div class="categories form">
<?php echo $this->Form->create('Sale',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit Sale'); ?></legend>
	<?php
	//pr($this->request->data);
		echo $this->Form->input('id');
		echo $this->Form->input('user_id',array('empty' => '(choose any user)','default'=>$this->request->data['User']['id']));
		echo $this->Form->input('membershipplans',array('empty' => '(choose any membership plan)','default'=>$this->request->data['MembershipPlan']['id']));
		echo $this->Form->input('renew');
		echo $this->Form->input('payment_method');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>