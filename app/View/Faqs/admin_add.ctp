<?php ?>
<script>
    $(document).ready(function () {
        $("#BlogAdminAddForm").validationEngine();
    });
</script>
<div class="blogs form">
<?php echo $this->Form->create('Faq', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add Faq'); ?></legend>
        <?php
        echo $this->Form->input('title',array('required'=>'required'));
        echo $this->Form->input('description',array('id' => 'faq_desc'));
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
            filebrowserBrowseUrl :'<?php echo $this->webroot; ?>ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo $this->webroot;?>ckeditor/filemanager/connectors/php/connector.php',
            filebrowserImageBrowseUrl : '<?php echo $this->webroot; ?>ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo $this->webroot;?>ckeditor/filemanager/connectors/php/connector.php',
            filebrowserFlashBrowseUrl :'<?php echo $this->webroot; ?>ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo $this->webroot;?>ckeditor/filemanager/connectors/php/connector.php',
            filebrowserUploadUrl  :'<?php echo $this->webroot;?>ckeditor/filemanager/connectors/php/upload.php?Type=File',
            filebrowserImageUploadUrl: '<?php echo $this->webroot; ?>ckeditor/filemanager/connectors/php/upload.php?Type=Image',
            filebrowserFlashUploadUrl: '<?php echo $this->webroot; ?>ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
        });
</script>
