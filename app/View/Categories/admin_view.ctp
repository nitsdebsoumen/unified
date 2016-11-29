<div class="categories view">
<h2><?php echo __('Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($category['Category']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Name'); ?></dt>
		<dd>
			<?php echo h($category['Category']['category_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($category['Country']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Description'); ?></dt>
		<dd>
			<?php echo h($category['Category']['category_description']); ?>
			&nbsp;
		</dd>
		<?php
		if($category['Category']['parent_id']==0)
		{
		}
		else
		{
		?>
		<dt><?php echo __('Parent Category'); ?></dt>
		<dd>
			<?php echo h($categoryname); ?>
			&nbsp;
		</dd>
		<?php
		}
		?>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
                    <?php
                    if(isset($category['CategoryImage']['0']['originalpath']) and !empty($category['CategoryImage']['0']['originalpath']))
                    {
                    ?>
                    <img alt="" src="<?php echo $this->webroot;?>img/cat_img/<?php echo $category['CategoryImage']['0']['originalpath'];?>" style=" height:80px; width:80px;">
                    <?php
                    }
                    else{
                    ?>
                   <img alt="" src="<?php echo $this->webroot;?>noimage.png" style=" height:80px; width:80px;">

                   <?php } ?>
		</dd>
                <dt><?php echo __('Is Principal'); ?></dt>
		<dd>
			<?php echo h($category['Category']['is_principal']==1?'Active':'Inactive'); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($category['Category']['status']==1?'Active':'Inactive'); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
