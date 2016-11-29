<div class="languagees view">
<h2><?php echo __('Languagee'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($languagee['Languagee']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Language Name'); ?></dt>
		<dd>
			<?php echo h($languagee['Languagee']['language_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Code'); ?></dt>
		<dd>
			<?php echo h($languagee['Languagee']['short_code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Languagee'), array('action' => 'edit', $languagee['Languagee']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Languagee'), array('action' => 'delete', $languagee['Languagee']['id']), null, __('Are you sure you want to delete # %s?', $languagee['Languagee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Languagees'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Languagee'), array('action' => 'add')); ?> </li>
	</ul>
</div>
