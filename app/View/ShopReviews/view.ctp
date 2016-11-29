<div class="favoriteShops view">
<h2><?php echo __('Favorite Shop'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($favoriteShop['FavoriteShop']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($favoriteShop['User']['id'], array('controller' => 'users', 'action' => 'view', $favoriteShop['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shop'); ?></dt>
		<dd>
			<?php echo $this->Html->link($favoriteShop['Shop']['id'], array('controller' => 'shops', 'action' => 'view', $favoriteShop['Shop']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Who Can View'); ?></dt>
		<dd>
			<?php echo h($favoriteShop['FavoriteShop']['who_can_view']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Favorite Shop'), array('action' => 'edit', $favoriteShop['FavoriteShop']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Favorite Shop'), array('action' => 'delete', $favoriteShop['FavoriteShop']['id']), null, __('Are you sure you want to delete # %s?', $favoriteShop['FavoriteShop']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Favorite Shops'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Favorite Shop'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shops'), array('controller' => 'shops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shop'), array('controller' => 'shops', 'action' => 'add')); ?> </li>
	</ul>
</div>
