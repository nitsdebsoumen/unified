<?php ?>
<script>
    $(document).ready(function () {
        $("#BlogAdminEditForm").validationEngine();
    });
</script>
<div class="blogs form">
<?php echo $this->Form->create('Faq',array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Edit Faq'); ?></legend>
	<?php
        echo $this->Form->input('id');
        echo $this->Form->input('title',array('required'=>'required'));
        echo $this->Form->input('description',array('required'=>'required', 'id' => 'faq_desc'));
        echo $this->Form->input('status');
        echo $this->Form->input('faqcategory_id',array('options' => $categories));
        echo $this->Form->input('order', array('default' => 0));
	?>

    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('faq_desc',
            {
                width: "95%"
            });
</script>

<?php //echo($this->element('admin_sidebar'));?>
