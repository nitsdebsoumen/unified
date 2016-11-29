<div class="shippingAddresses view">
<h2><?php echo __('Order'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($order['OrderItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['User']['id'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($order['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($order['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course Title'); ?></dt>
		<dd>
			<?php echo h($order['Post']['post_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course Price'); ?></dt>
		<dd>
			<?php echo h($order['Post']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo $order['OrderItem']['quantity']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Price'); ?></dt>
		<dd>
			<?php echo $order['Post']['price']*$order['OrderItem']['quantity']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Date'); ?></dt>
		<dd>
			<?php echo h($order['OrderItem']['payment_date']); ?>
			&nbsp;
		</dd>
	
	</dl>
</div>
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Shipping Address'), array('action' => 'edit', $order['OrderItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Shipping Address'), array('action' => 'delete', $order['OrderItem']['id']), null, __('Are you sure you want to delete # %s?', $order['OrderItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Shipping Addresses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shipping Address'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div> -->
