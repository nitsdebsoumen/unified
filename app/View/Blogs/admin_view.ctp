<div class="categories view">
<h2><?php echo __('Blog'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($blog_view['Blog']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Blog Title'); ?></dt>
		<dd>
			<?php echo h($blog_view['Blog']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Name'); ?></dt>
		<dd>
			<?php echo h($blog_view['Category']['name']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($blog_view['Blog']['description']); ?>
			&nbsp;
		</dd>
                
		<dt><?php echo __('Blog Image'); ?></dt>
		<dd>
                    <?php
                    $uploadImgPath = WWW_ROOT.'blogs_image';
                    if($blog_view['Blog']['image']!='' && file_exists($uploadImgPath . '/' . $blog_view['Blog']['image'])){   
                    ?>
                    <img alt="" src="<?php echo $this->webroot;?>blogs_image/<?php echo $blog_view['Blog']['image'];?>" style=" height:80px; width:80px;">
                    <?php
                    }else{
                    ?>
                   <img alt="" src="<?php echo $this->webroot;?>noimage.png" style=" height:80px; width:80px;">

                   <?php } ?>
		</dd>
		<dt><?php echo __('Blog Post Date'); ?></dt>
		<dd>
			<?php echo h(date("dS M Y H:i a",strtotime($blog_view['Blog']['create_date']))); ?>
			&nbsp;
		</dd>
                
		<dt><?php echo __('Blog Status'); ?></dt>
		<dd>
			<?php echo h($blog_view['Blog']['status']==1?'Active':'Inactive'); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
