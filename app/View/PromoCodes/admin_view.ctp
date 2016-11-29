<div class="shippingAddresses view">
<h2><?php echo __('Promo Code'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($promocode['PromoCode']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promo Code Title'); ?></dt>
		<dd>
			<?php echo h($promocode['PromoCode']['promo_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($promocode['PromoCode']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number of Use'); ?></dt>
		<dd>
			<?php echo h($promocode['PromoCode']['no_of_use']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Discount in %'); ?></dt>
		<dd>
			<?php echo h($promocode['PromoCode']['discount'].'%'); ?>
			&nbsp;
		</dd>
			
	</dl>
</div>
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Shipping Address'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Shipping Address'), array('action' => 'delete', $order['Order']['id']), null, __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Shipping Addresses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shipping Address'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div> -->
