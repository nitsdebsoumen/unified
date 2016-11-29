<?php
//pr($posts);
?>
<div class="categories form">
    <?php echo $this->Form->create('Post', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Edit Post'); ?></legend>
        <?php
        //pr($this->request->data);
        echo $this->Form->input('id');
        echo $this->Form->input('user_id', array('empty' => '(choose any user)'));
        echo $this->Form->input('category_id', array('empty' => '(choose any category)'));
        echo $this->Form->input('post_title');
        echo $this->Form->input('post_description', array('id' => 'post_desc'));
        echo $this->Form->input('price');
        echo $this->Form->input('CourseLocation', array('options'=>$location, 'id'=>'PostLocation')); 
        echo $this->Form->input('is_approve');
        echo $this->Form->input('featured');
        echo $this->Form->input('country');
        echo $this->Form->input('state');
        echo $this->Form->input('city');
        echo $this->Form->input('address');
        echo $this->Form->input('postimage_id', array('type' => 'hidden', 'default' => $this->request->data['PostImage']['0']['id']));
        echo $this->Form->input('hide_img', array('type' => 'hidden', 'value' => isset($this->request->data['PostImage']['0']['originalpath']) ? $this->request->data['PostImage']['0']['originalpath'] : ''));
        echo $this->Form->input('image', array('type' => 'file'));
        ?>

        <div>
            <?php
            if (isset($this->request->data['PostImage']['0']['originalpath']) and ! empty($this->request->data['PostImage']['0']['originalpath'])) {
                ?>
                <img alt="" src="<?php echo $this->webroot; ?>img/post_img/<?php echo $this->request->data['PostImage']['0']['originalpath']; ?>" style=" height:80px; width:80px;">
                <?php
            } else {
                ?>
                <img alt="" src="<?php echo $this->webroot; ?>noimage.png" style=" height:80px; width:80px;">

            <?php } ?>
        </div> 
        <?php //}  ?>

    </fieldset>

    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
<script type="text/javascript" src="<?php echo $this->webroot; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('post_desc',
            {
                width: "95%"
            });
</script>