<div class="categories form">
    <?php echo $this->Form->create('Seo', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add SEO KEYWORDS'); ?></legend>
        <?php
        echo $this->Form->input('page_name');
        echo $this->Form->input('meta_keyword');
        echo $this->Form->input('meta_description');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type="text/javascript" src="<?php echo $this->webroot; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('seo_keyword',
            {
                width: "95%"
            });
</script>
