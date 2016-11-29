<div class="categories form">
<?php echo $this->Form->create('Marketplace',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Add Marketplace'); ?></legend>
	<?php
		echo $this->Form->input('user_id',array('empty' => '(choose any user)'));
		echo $this->Form->input('category_id',array('empty' => '(choose any category)'));
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('shipping');
		echo $this->Form->input('state');
		echo $this->Form->input('city');
		echo $this->Form->input('zipcode');
		echo $this->Form->input('country_id',array('empty' => '(choose any country)'));
		echo $this->Form->input('showlocation');
		echo $this->Form->input('is_approve');
		echo $this->Form->input('image',array('type'=>'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>