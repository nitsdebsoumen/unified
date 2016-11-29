<div class="currencies form">
<?php echo $this->Form->create('Currency'); ?>
	<fieldset>
		<legend><?php echo __('Edit Currency'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('currency_name');
		echo $this->Form->input('short_code');
		echo $this->Form->input('symbol');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Currency.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Currency.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Currencies'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Preferences'), array('controller' => 'preferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Preference'), array('controller' => 'preferences', 'action' => 'add')); ?> </li>
	</ul>
</div>
