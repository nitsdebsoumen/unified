<?php ?>
<script>
    $(document).ready(function () {
        $("#BlogAdminEditForm").validationEngine();
    });
</script>
<style>
    table tr td { text-align: left; }
</style>
<div class="blogs form">
<?php echo $this->Form->create('Faqcategory',array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Edit Faq'); ?></legend>
	<?php
        echo $this->Form->input('id');
        echo $this->Form->input('name',array('required'=>'required'));
        echo $this->Form->input('desc',array('required'=>'required', 'id' => 'faq_cat'));
        echo $this->Form->input('status');
	?>

    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('faq_cat',
            {
                width: "95%"
            });
</script>
