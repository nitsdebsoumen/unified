<div class="contents form">
<?php 
echo $this->Html->script('ckeditor/ckeditor'); 
echo $this->Form->create('FeaturedPlan'); ?>
	<fieldset>
		<legend><?php echo __('Add Featured Plan'); ?></legend>
	<?php
	    echo $this->Form->input('title');
		// echo $this->Form->input('no_of_post');
		// echo $this->Form->input('no_of_marketplace');
		echo $this->Form->input('price');
		echo $this->Form->input('duration');
		//echo $this->Form->input('content');
		echo $this->Form->input('content', array('type' => 'textarea'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>