<div class="privacies view">
<h2><?php echo __('Privacy'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($privacy['Privacy']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($privacy['User']['id'], array('controller' => 'users', 'action' => 'view', $privacy['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Findability'); ?></dt>
		<dd>
			<?php echo h($privacy['Privacy']['findability']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Privacy'), array('action' => 'edit', $privacy['Privacy']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Privacy'), array('action' => 'delete', $privacy['Privacy']['id']), null, __('Are you sure you want to delete # %s?', $privacy['Privacy']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Privacies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Privacy'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
