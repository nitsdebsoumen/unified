<div class="categories form">
<?php echo $this->Form->create('Newsletter',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Add Newsletters'); ?></legend>
	<?php
		
		echo $this->Form->input('email');
		
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>

