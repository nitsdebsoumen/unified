<?php ?>
<script>
    $(document).ready(function () {
        $("#BlogAdminEditForm").validationEngine();
    });
</script>
<div class="partners form">
<?php echo $this->Form->create('Partner',array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Edit Faq'); ?></legend>
        <?php
        if($this->request->data['Partner']['image'] != '') {
        ?>
        <div style="width: 100%;">
            <img src="<?php echo $this->webroot.'partners/'.$this->request->data['Partner']['image'] ?>" style="max-width: 100%;" />
        </div>
        <?php
        }
        ?>
	<?php
        echo $this->Form->input('id');
        echo $this->Form->input('image', array('type' => 'file'));
        echo $this->Form->input('name',array('required'=>'required'));
        echo $this->Form->input('desc',array('label' => 'Description', 'id' => 'banner_desc'));
        echo $this->Form->input('status');
	?>

    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('banner_desc',
            {
                width: "95%"
            });
</script>


