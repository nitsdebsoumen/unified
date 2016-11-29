<div class="categories form">
    <?php echo $this->Form->create('Seo', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Edit SEO KEYWORDS'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('page_name', array('disabled' => 'disabled'));
        echo $this->Form->input('meta_keyword');
        echo $this->Form->input('meta_description', array('id' => 'seo_keyword'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type="text/javascript" src="<?php echo $this->webroot; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('seo_keyword',
            {
                width: "100%"
            });
</script>