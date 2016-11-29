<div class="categories form">
<?php 
echo $this->Html->script('ckeditor/ckeditor'); 
echo $this->Form->create('Blog',array('enctype'=>'multipart/form-data'));   
?>
	<fieldset>
		<legend><?php echo __('Add Blog'); ?></legend>
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
                                            <option value="<?php echo $subcat['Category']['id'];?>" <?php //if($subcat['Category']['id']==$task_details['Task']['category_id']){ echo 'selected="selected"';}?>><?php echo $subcat['Category']['name'];?></value>
                                    <?php
                                                }
                                            }
                                            ?>
                                    </optgroup>	
                        <?php }?>
                    </select>
		</div>
            <?php
		echo $this->Form->input('title',array('required'=>'required', 'label'=>'Blog Title'));
            ?>
                <div class="input text">
                    <label for="BlogAnswer">Description</label>
                    <textarea name="data[Blog][description]" id="BlogAnswer"></textarea>
                </div>
                <?php
		echo $this->Form->input('image',array('type'=>'file'));
		echo $this->Form->input('status', array('type'=>'checkbox', 'label'=>'Active'));
                ?>
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