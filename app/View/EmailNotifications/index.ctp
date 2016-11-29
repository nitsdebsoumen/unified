<div class="emailNotifications index">
	<h2><?php echo __('Email Notifications'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('someone_sends_me_a_convo'); ?></th>
			<th><?php echo $this->Paginator->sort('send_convo'); ?></th>
			<th><?php echo $this->Paginator->sort('someone_follows_me'); ?></th>
			<th><?php echo $this->Paginator->sort('listings_about_to_expire'); ?></th>
			<th><?php echo $this->Paginator->sort('my_seller_activity'); ?></th>
			<th><?php echo $this->Paginator->sort('whats_new'); ?></th>
			<th><?php echo $this->Paginator->sort('recommended_features'); ?></th>
			<th><?php echo $this->Paginator->sort('tips_of_improving_shop'); ?></th>
			<th><?php echo $this->Paginator->sort('provide_feedback'); ?></th>
			<th><?php echo $this->Paginator->sort('receive_feedback'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($emailNotifications as $emailNotification): ?>
	<tr>
		<td><?php echo h($emailNotification['EmailNotification']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($emailNotification['User']['id'], array('controller' => 'users', 'action' => 'view', $emailNotification['User']['id'])); ?>
		</td>
		<td><?php echo h($emailNotification['EmailNotification']['someone_sends_me_a_convo']); ?>&nbsp;</td>
		<td><?php echo h($emailNotification['EmailNotification']['send_convo']); ?>&nbsp;</td>
		<td><?php echo h($emailNotification['EmailNotification']['someone_follows_me']); ?>&nbsp;</td>
		<td><?php echo h($emailNotification['EmailNotification']['listings_about_to_expire']); ?>&nbsp;</td>
		<td><?php echo h($emailNotification['EmailNotification']['my_seller_activity']); ?>&nbsp;</td>
		<td><?php echo h($emailNotification['EmailNotification']['whats_new']); ?>&nbsp;</td>
		<td><?php echo h($emailNotification['EmailNotification']['recommended_features']); ?>&nbsp;</td>
		<td><?php echo h($emailNotification['EmailNotification']['tips_of_improving_shop']); ?>&nbsp;</td>
		<td><?php echo h($emailNotification['EmailNotification']['provide_feedback']); ?>&nbsp;</td>
		<td><?php echo h($emailNotification['EmailNotification']['receive_feedback']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $emailNotification['EmailNotification']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $emailNotification['EmailNotification']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $emailNotification['EmailNotification']['id']), null, __('Are you sure you want to delete # %s?', $emailNotification['EmailNotification']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Email Notification'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
