<div class="categories form">
<?php echo $this->Form->create('Analytic',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit Analytic'); ?></legend>
	<?php
	
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('description',array('id'=>'analytic'));
		echo $this->Form->input('status',['type'=>'checkbox']);
		
	?>
 <?php  ?>

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('analytic',
            {
                width: "95%"
            });
</script>