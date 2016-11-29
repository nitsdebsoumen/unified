<div class="categories form">
<?php echo $this->Form->create('Category',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Add Category'); ?></legend>
	<?php
		echo $this->Form->input('category_name');
		echo $this->Form->input('categories',array('empty' => '(choose one)'));
		echo $this->Form->input('category_description',array('id'=>'cat_desc'));
		echo $this->Form->input('country_id');
		echo $this->Form->input('is_principal');
		echo $this->Form->input('status');
		echo $this->Form->input('image',array('type'=>'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('cat_desc',
            {
                width: "95%"
            });
</script>