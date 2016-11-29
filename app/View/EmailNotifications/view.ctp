<div class="emailNotifications view">
<h2><?php echo __('Email Notification'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($emailNotification['User']['id'], array('controller' => 'users', 'action' => 'view', $emailNotification['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Someone Sends Me A Convo'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['someone_sends_me_a_convo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Send Convo'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['send_convo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Someone Follows Me'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['someone_follows_me']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Listings About To Expire'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['listings_about_to_expire']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('My Seller Activity'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['my_seller_activity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Whats New'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['whats_new']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recommended Features'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['recommended_features']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tips Of Improving Shop'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['tips_of_improving_shop']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Provide Feedback'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['provide_feedback']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Receive Feedback'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['receive_feedback']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Email Notification'), array('action' => 'edit', $emailNotification['EmailNotification']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Email Notification'), array('action' => 'delete', $emailNotification['EmailNotification']['id']), null, __('Are you sure you want to delete # %s?', $emailNotification['EmailNotification']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Email Notifications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Notification'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
