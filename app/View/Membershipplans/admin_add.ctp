<div class="contents form">
<?php 
echo $this->Html->script('ckeditor/ckeditor'); 
echo $this->Form->create('MembershipPlan'); ?>
	<fieldset>
		<legend><?php echo __('Add Membership Plan'); ?></legend>
	<?php
	    echo $this->Form->input('title');
		echo $this->Form->input('no_of_post');
		echo $this->Form->input('no_of_marketplace');
		echo $this->Form->input('price');
		//echo $this->Form->input('content');
		//echo $this->Form->textarea('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>