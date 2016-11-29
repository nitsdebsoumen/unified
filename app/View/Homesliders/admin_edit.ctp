<?php ?>
<script>
    $(document).ready(function () {
        $("#BlogAdminEditForm").validationEngine();
    });
</script>
<div class="blogs form">
<?php echo $this->Form->create('Homeslider',array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Edit Faq'); ?></legend>
        <?php
        if($this->request->data['Homeslider']['image'] != '') {
        ?>
        <div style="width: 100%;">
            <img src="<?php echo $this->webroot.'homeslider/'.$this->request->data['Homeslider']['image'] ?>" style="width: 100%;" />
        </div>
        <?php
        }
        ?>
	<?php
        echo $this->Form->input('id');
        echo $this->Form->input('image', array('type' => 'hidden', 'name' => 'saved_image'));
        echo $this->Form->input('image', array('type' => 'file'));
        echo $this->Form->input('title',array('required'=>'required'));
        echo $this->Form->input('desc',array('label' => 'Description', 'id' => 'home_desc'));
        echo $this->Form->input('status');
        echo $this->Form->input('order', array('default' => 0));
	?>

    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('home_desc',
            {
                width: "95%"
            });
</script>
