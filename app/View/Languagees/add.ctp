<div class="languagees form">
<?php echo $this->Form->create('Languagee'); ?>
	<fieldset>
		<legend><?php echo __('Add Languagee'); ?></legend>
	<?php
		echo $this->Form->input('language_name');
		echo $this->Form->input('short_code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Languagees'), array('action' => 'index')); ?></li>
	</ul>
</div>
