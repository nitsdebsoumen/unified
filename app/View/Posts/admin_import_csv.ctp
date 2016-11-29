<div class="categories form">
    
    <h3>Use this format for uploading CSV <a class="btn btn-info" href="<?php echo $this->webroot . 'bulkupload/bulkupload.csv' ?>" download><i class="fa fa-plus"></i> Download</a></h3>
    
    <?php echo $this->Form->create('', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Upload from CSV'); ?></legend>
        <div class="input file">
            <label for="csv">Upload CSV File</label>
            <input id="csv" type="file" name="data[csv]">
        </div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>