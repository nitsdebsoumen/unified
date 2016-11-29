<div class="favoriteShops form">
<?php echo $this->Form->create('FavoriteShop'); ?>
	<fieldset>
		<legend><?php echo __('Add Favorite Shop'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('shop_id');
		echo $this->Form->input('who_can_view');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Favorite Shops'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shops'), array('controller' => 'shops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shop'), array('controller' => 'shops', 'action' => 'add')); ?> </li>
	</ul>
</div>
