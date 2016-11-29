<div class="categories form">
<?php 
echo $this->Html->script('ckeditor/ckeditor');
echo $this->Form->create('Blog',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit Blog'); ?></legend>
                <div class="input select">
                    <label for="FaqFaqcategories">Blog category</label>
                    <select name="data[Blog][cat_id]" required="required">
                        <option value="">Select Category--</option>
                        <?php if(isset($categories) && !empty($categories))
                            foreach($categories as $category){ ?>
                                    <optgroup label="<?php echo $category['Category']['name']?>">
                                            <?php 
                                            $subcats = $this->requestAction(array('controller' => 'blogs', 'action' => 'admin_getsubcat/'.$category['Category']['id']));
                                            if(!empty($subcats)){
                                                foreach($subcats as $subcat){
                                            ?>
                                            <option value="<?php echo $subcat['Category']['id'];?>" <?php if($subcat['Category']['id']==$this->request->data['Blog']['cat_id']){ echo 'selected="selected"';}?>><?php echo $subcat['Category']['name'];?></value>
                                    <?php
                                                }
                                            }
                                            ?>
                                    </optgroup>	
                        <?php }?>
                    </select>
		</div>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title',array('required'=>'required', 'label'=>'Blog Title'));
                ?>
                <div class="input text">
                    <label for="BlogAnswer">Description</label>
                    <textarea name="data[Blog][description]" required="required" id="BlogAnswer"><?php echo isset($this->request->data['Blog']['description'])?$this->request->data['Blog']['description']:'';?></textarea>
                </div>
                <?php
		echo $this->Form->input('image',array('type'=>'file'));
		echo $this->Form->input('status', array('type'=>'checkbox', 'label'=>'Active'));
		echo $this->Form->input('hide_img',array('type' => 'hidden','value'=>isset($this->request->data['Blog']['image'])?$this->request->data['Blog']['image']:''));

                ?>
                <div>
                    <?php
                    $uploadImgPath = WWW_ROOT.'blogs_image';
                    if( $this->request->data['Blog']['image']!='' && file_exists($uploadImgPath . '/' .  $this->request->data['Blog']['image'])){   
                    ?>
                    <img alt="" src="<?php echo $this->webroot;?>blogs_image/<?php echo $this->request->data['Blog']['image'];?>" style=" height:80px; width:80px;">
                    <?php
                    }
                    else{
                    ?>
                        <img alt="" src="<?php echo $this->webroot;?>noimage.png" style=" height:80px; width:80px;">

                    <?php } ?>
                </div> 
                

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type="text/javascript">
    CKEDITOR.replace( 'BlogAnswer',
    {
    width: "96%"
    });
</script>
<?php //echo $this->element('admin_sidebar'); ?>