<div class="categories form">
<?php echo $this->Form->create('Marketplace',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit Marketplace'); ?></legend>
	<?php
	//pr($this->request->data);
		echo $this->Form->input('id');
		echo $this->Form->input('user_id',array('empty' => '(choose any user)','default'=>$this->request->data['User']['id']));
		echo $this->Form->input('category_id',array('empty' => '(choose any category)','default'=>$this->request->data['Category']['id']));
		echo $this->Form->input('title');
		echo $this->Form->input('description');
	    echo $this->Form->input('shipping');
		echo $this->Form->input('state');
		echo $this->Form->input('city');
		echo $this->Form->input('zipcode');
		echo $this->Form->input('country_id',array('empty' => '(choose any country)','default'=>$this->request->data['Country']['id']));
		echo $this->Form->input('showlocation');
		echo $this->Form->input('is_approve');
		echo $this->Form->input('marketplaceimage_id',array('type' => 'hidden','default' =>$this->request->data['MarketplaceImage']['0']['id']));
                echo $this->Form->input('hide_img',array('type' => 'hidden','value'=>isset( $this->request->data['MarketplaceImage']['0']['originalpath'])? $this->request->data['MarketplaceImage']['0']['originalpath']:''));
		echo $this->Form->input('image',array('type'=>'file'));

	?>
                
                <div>
                    <?php
                        if(isset( $this->request->data['MarketplaceImage']['0']['originalpath']) and !empty( $this->request->data['MarketplaceImage']['0']['originalpath']))
                    {
                    ?>
                    <img alt="" src="<?php echo $this->webroot;?>img/marketplace_img/<?php echo $this->request->data['MarketplaceImage']['0']['originalpath'];?>" style=" height:80px; width:80px;">
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