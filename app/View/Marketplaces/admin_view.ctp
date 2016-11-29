<div class="categories view">
<h2><?php echo __('Marketplace'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($post['Marketplace']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Marketplace Title'); ?></dt>
		<dd>
			<?php echo h($post['Marketplace']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Marketplace Description'); ?></dt>
		<dd>
			<?php echo h($post['Marketplace']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Showlocation'); ?></dt>
		<dd>
			<?php echo h($post['Marketplace']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($post['Marketplace']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($post['Marketplace']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip Code'); ?></dt>
		<dd>
			<?php echo h($post['Marketplace']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($post['Country']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo h($post['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo h($post['Category']['category_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
                    <?php
                    if(isset($post['MarketplaceImage']['0']['originalpath']) and !empty($post['MarketplaceImage']['0']['originalpath']))
                    {
                    ?>
                    <img alt="" src="<?php echo $this->webroot;?>img/post_img/<?php echo $post['MarketplaceImage']['0']['originalpath'];?>" style=" height:80px; width:80px;">
                    <?php
                    }
                    else{
                    ?>
                   <img alt="" src="<?php echo $this->webroot;?>noimage.png" style=" height:80px; width:80px;">

                   <?php } ?>
		</dd>
		<dt><?php echo __('Approve'); ?></dt>
		<dd>
			<?php echo h($post['Marketplace']['is_approve']==1?'No':'Yes'); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
