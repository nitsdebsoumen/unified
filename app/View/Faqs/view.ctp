<div class="blogs view">
<h2><?php echo __('Blog'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($blog['Blog']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tittle'); ?></dt>
		<dd>
			<?php echo h($blog['Blog']['tittle']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($blog['Blog']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($blog['User']['id'], array('controller' => 'users', 'action' => 'view', $blog['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post Date Time'); ?></dt>
		<dd>
			<?php echo h($blog['Blog']['post_date_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Blog'), array('action' => 'edit', $blog['Blog']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Blog'), array('action' => 'delete', $blog['Blog']['id']), null, __('Are you sure you want to delete # %s?', $blog['Blog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Blogs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blog Comments'), array('controller' => 'blog_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Comment'), array('controller' => 'blog_comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Blog Comments'); ?></h3>
	<?php if (!empty($blog['BlogComment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Blog Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Comments'); ?></th>
		<th><?php echo __('Comment Date Time'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($blog['BlogComment'] as $blogComment): ?>
		<tr>
			<td><?php echo $blogComment['id']; ?></td>
			<td><?php echo $blogComment['blog_id']; ?></td>
			<td><?php echo $blogComment['user_id']; ?></td>
			<td><?php echo $blogComment['comments']; ?></td>
			<td><?php echo $blogComment['comment_date_time']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'blog_comments', 'action' => 'view', $blogComment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'blog_comments', 'action' => 'edit', $blogComment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'blog_comments', 'action' => 'delete', $blogComment['id']), null, __('Are you sure you want to delete # %s?', $blogComment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Blog Comment'), array('controller' => 'blog_comments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
