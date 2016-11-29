<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('gender');
		echo $this->Form->input('city');
		echo $this->Form->input('country');
		echo $this->Form->input('birthday');
		echo $this->Form->input('about');
		echo $this->Form->input('favorite_materials');
		echo $this->Form->input('include_shop');
		echo $this->Form->input('include_favorite_items');
		echo $this->Form->input('include_favorite_shops');
		echo $this->Form->input('include_treasury_lists');
		echo $this->Form->input('include_teams');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('join_active');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Email Notifications'), array('controller' => 'email_notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Notification'), array('controller' => 'email_notifications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Favorite Lists'), array('controller' => 'favorite_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Favorite List'), array('controller' => 'favorite_lists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Favorite Shops'), array('controller' => 'favorite_shops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Favorite Shop'), array('controller' => 'favorite_shops', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Favorite Treasuries'), array('controller' => 'favorite_treasuries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Favorite Treasury'), array('controller' => 'favorite_treasuries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inbox Messages'), array('controller' => 'inbox_messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inbox Message'), array('controller' => 'inbox_messages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Preferences'), array('controller' => 'preferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Preference'), array('controller' => 'preferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Privacies'), array('controller' => 'privacies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Privacy'), array('controller' => 'privacies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Securities'), array('controller' => 'securities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Security'), array('controller' => 'securities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sent Messages'), array('controller' => 'sent_messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sent Message'), array('controller' => 'sent_messages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shipping Addresses'), array('controller' => 'shipping_addresses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shipping Address'), array('controller' => 'shipping_addresses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shops'), array('controller' => 'shops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shop'), array('controller' => 'shops', 'action' => 'add')); ?> </li>
	</ul>
</div>
