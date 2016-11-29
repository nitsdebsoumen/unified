<div class="categories form">
<?php echo $this->Form->create('Language',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Add Language Management'); ?></legend>
	<?php
		
		echo $this->Form->input('short_name');
		echo $this->Form->input('full_name');
				
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>

