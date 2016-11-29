<div class="contents form">
<?php 
//echo $this->Html->script('ckeditor/ckeditor'); 
echo $this->Form->create('MembershipPlan'); ?>
	<fieldset>
		<legend><?php echo __('Edit Content'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		//echo $this->Form->input('no_of_post');
		//echo $this->Form->input('no_of_marketplace');
		echo $this->Form->input('price');
		echo $this->Form->input('plan_code');
		echo $this->Form->input('duration');
		
?>
<textarea name="data[MembershipPlan][content]" id="Contentcontent" style="width:900px; height:600px;" class="validate[required]" ><?php echo $this->request->data['MembershipPlan']['content']; ?></textarea>
    

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>

<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('Contentcontent',
            {
                width: "95%"
            });
</script>
