<div class="contents form">
<?php 
//echo $this->Html->script('ckeditor/ckeditor'); 
echo $this->Form->create('CmsPage'); ?>
    <fieldset>
        <legend><?php echo __('Edit Content'); ?></legend>
	<?php
		echo $this->Form->input('id');
                echo $this->Form->input('page_title');
		echo $this->Form->input('page_heading');
		//echo $this->Form->input('content');
		//echo $this->Form->textarea('content');
                echo $this->Form->input('show_in_header');
                echo $this->Form->input('show_in_footer');
	?>

        <div class="input select">
            <label for="FaqFaqcategoryId">Category</label>
            <select id="FaqFaqcategoryId" name="data[CmsPage][contentcategory_id]">
                <option value="">Select Category</option>
                <option value="1" <?php echo ($this->request->data['CmsPage']['contentcategory_id'] == '1') ? 'selected' : ''; ?>>Category 1</option>
                <option value="2" <?php echo ($this->request->data['CmsPage']['contentcategory_id'] == '2') ? 'selected' : ''; ?>>Category 2</option>
                <option value="3" <?php echo ($this->request->data['CmsPage']['contentcategory_id'] == '3') ? 'selected' : ''; ?>>Category 3</option>
                <option value="4" <?php echo ($this->request->data['CmsPage']['contentcategory_id'] == '4') ? 'selected' : ''; ?>>Category 4</option>
            </select>
        </div>

        <textarea name="data[CmsPage][page_description]" id="Contentcontent" style="width:900px; height:600px;" class="validate[required]" ><?php echo $this->request->data['CmsPage']['page_description']; ?></textarea>
        <textarea name="data[CmsPage][page_description_sp]" id="Contentcontent_sp" style="width:900px; height:600px;" class="validate[required]" ><?php echo $this->request->data['CmsPage']['page_description_sp']; ?></textarea>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('Contentcontent',
            {
                width: "95%"
            });
    CKEDITOR.replace('Contentcontent_sp',
            {
                width: "95%"
            });
</script>

<?php //echo $this->element('admin_sidebar'); ?>
