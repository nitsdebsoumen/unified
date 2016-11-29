<div class="categories form">
<?php echo $this->Form->create('Seourl',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Add Seo URL'); ?></legend>
	<?php
		
		echo $this->Form->input('pageID');
		echo $this->Form->input('url');
		
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>

