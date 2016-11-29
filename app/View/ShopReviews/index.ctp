<div class="favoriteShops index">
	<h2><?php echo __('Favorite Shops'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('shop_id'); ?></th>
			<th><?php echo $this->Paginator->sort('who_can_view'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($favoriteShops as $favoriteShop): ?>
	<tr>
		<td><?php echo h($favoriteShop['FavoriteShop']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($favoriteShop['User']['id'], array('controller' => 'users', 'action' => 'view', $favoriteShop['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($favoriteShop['Shop']['id'], array('controller' => 'shops', 'action' => 'view', $favoriteShop['Shop']['id'])); ?>
		</td>
		<td><?php echo h($favoriteShop['FavoriteShop']['who_can_view']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $favoriteShop['FavoriteShop']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $favoriteShop['FavoriteShop']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $favoriteShop['FavoriteShop']['id']), null, __('Are you sure you want to delete # %s?', $favoriteShop['FavoriteShop']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Favorite Shop'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shops'), array('controller' => 'shops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shop'), array('controller' => 'shops', 'action' => 'add')); ?> </li>
	</ul>
</div>
