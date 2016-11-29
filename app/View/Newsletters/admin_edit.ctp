<div class="categories form">
<?php echo $this->Form->create('Newsletter',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit Newsletter'); ?></legend>
	<?php
	
		echo $this->Form->input('id');
		echo $this->Form->input('email');
		
		
	?>
 <?php  ?>

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
