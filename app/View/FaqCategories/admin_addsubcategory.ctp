<div class="categories form">
<?php echo $this->Form->create('Category'); ?>
	<fieldset>
		<legend><?php echo __('Add Sub Category of'); ?>&nbsp;<?php echo($categoryname);?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('active');
		echo $this->Form->input('parent_id',array('value' => $id, 'type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>