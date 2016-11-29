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
			<?php echo h($category['Category']['name']); ?>
			&nbsp;
		</dd>
		<?php
		if($category['Category']['parent_id']!=0)
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
                <?php
		if($category['Category']['parent_id']==0)
		{
		?>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
                    <?php
                    if(isset($category['Category']['image']) and !empty($category['Category']['image']))
                    {
                    ?>
                    <img alt="" src="<?php echo $this->webroot;?>img/cat_img/<?php echo $category['Category']['image'];?>" style=" height:80px; width:80px;">
                    <?php
                    }
                    else{
                    ?>
                   <img alt="" src="<?php echo $this->webroot;?>noimage.png" style=" height:80px; width:80px;">

                   <?php } ?>
		</dd>
		<?php
		}
		?>
                
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($category['Category']['active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php echo $this->element('admin_sidebar'); ?>