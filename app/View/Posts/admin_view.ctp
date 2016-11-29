<?php pr($post);?>
<div class="categories view">
<h2><?php echo __('Post'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($post['Post']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post Name'); ?></dt>
		<dd>
			<?php echo h($post['Post']['post_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post Description'); ?></dt>
		<dd>
			<?php echo h($post['Post']['post_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
                    <?php
                    if(isset($post['PostImage']['0']['originalpath']) and !empty($post['PostImage']['0']['originalpath']))
                    {
                    ?>
                    <img alt="" src="<?php echo $this->webroot;?>img/post_img/<?php echo $post['PostImage']['0']['originalpath'];?>" style=" height:80px; width:80px;">
                    <?php
                    }
                    else{
                    ?>
                   <img alt="" src="<?php echo $this->webroot;?>noimage.png" style=" height:80px; width:80px;">

                   <?php } ?>
		</dd>
		<dt><?php echo __('Approve'); ?></dt>
		<dd>
			<?php echo h($post['Post']['is_approve']==1?'No':'Yes'); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Featured'); ?></dt>
		<dd>
			<?php echo h($post['Post']['featured']==1?'Yes':'No'); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
