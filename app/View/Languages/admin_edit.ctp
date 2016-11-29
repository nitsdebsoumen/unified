<div class="categories form">
<?php echo $this->Form->create('Language',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit Language Management'); ?></legend>
	<?php
	
		echo $this->Form->input('id');
		echo $this->Form->input('short_name');
		echo $this->Form->input('full_name');
				
	?>
                
           
                <?php  ?>

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
