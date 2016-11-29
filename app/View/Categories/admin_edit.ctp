<div class="categories form">
<?php echo $this->Form->create('Category',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('category_name');
		echo $this->Form->input('categories',array('empty' => '(choose one)','default'=>$this->request->data['Category']['parent_id']));
		echo $this->Form->input('category_description',array('id'=>'cat_desc'));
		echo $this->Form->input('country_id');
		echo $this->Form->input('is_principal');
		echo $this->Form->input('parent_id',array('type' => 'hidden'));
		echo $this->Form->input('categoryimage_id',array('type' => 'hidden','default' =>$this->request->data['CategoryImage']['0']['id']));
		echo $this->Form->input('status');
                echo $this->Form->input('featured');
                echo $this->Form->input('hide_img',array('type' => 'hidden','value'=>isset( $this->request->data['CategoryImage']['0']['originalpath'])? $this->request->data['CategoryImage']['0']['originalpath']:''));
		echo $this->Form->input('image',array('type'=>'file'));

	?>
                
                <div>
                    <?php
                        if(isset( $this->request->data['CategoryImage']['0']['originalpath']) and !empty( $this->request->data['CategoryImage']['0']['originalpath']))
                    {
                    ?>
                    <img alt="" src="<?php echo $this->webroot;?>img/cat_img/<?php echo $this->request->data['CategoryImage']['0']['originalpath'];?>" style=" height:80px; width:80px;">
                    <?php
                    }
                    else{
                    ?>
                   <img alt="" src="<?php echo $this->webroot;?>noimage.png" style=" height:80px; width:80px;">

                    <?php } ?>
                </div> 
                <?php //} ?>

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('cat_desc',
            {
                width: "95%"
            });
</script>