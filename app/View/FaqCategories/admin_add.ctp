<div class="categories form">
<?php echo $this->Form->create('FaqCategory',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Add Faq Category'); ?></legend>
	<?php
		echo $this->Form->input('name');
		
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
