<div class="emailNotifications form">
<?php echo $this->Form->create('EmailNotification'); ?>
	<fieldset>
		<legend><?php echo __('Edit Email Notification'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('someone_sends_me_a_convo');
		echo $this->Form->input('send_convo');
		echo $this->Form->input('someone_follows_me');
		echo $this->Form->input('listings_about_to_expire');
		echo $this->Form->input('my_seller_activity');
		echo $this->Form->input('whats_new');
		echo $this->Form->input('recommended_features');
		echo $this->Form->input('tips_of_improving_shop');
		echo $this->Form->input('provide_feedback');
		echo $this->Form->input('receive_feedback');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('EmailNotification.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('EmailNotification.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Email Notifications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
