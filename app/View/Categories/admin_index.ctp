<div class="categories index">
    <h2><?php echo __('Course Categories'); ?></h2>
    <div>
       <?php //echo $this->Form->create("User");?>
        <form name="Searchuserfrm" method="post" action="" id="Searchuserfrm">   
            <table style=" border:none;">
                <tr>
                    <td>Keyword</td>
                    <td><input type="text" name="keyword" value="<?php echo isset($keywords)?$keywords:'';?>" placeholder="Search by Keyword."></td>
                    <td>Activity Status</td>
                    <td><select name="search_is_active" id="search_is_active">
                            <option value="" >Select Option</option>
                            <option value="1" <?php echo (isset($Newsearch_is_active) && $Newsearch_is_active=='1')?'selected':'';?>>Active</option>
                            <option value="0" <?php echo (isset($Newsearch_is_active) && $Newsearch_is_active=='0')?'selected':'';?>>Inactive</option>
                        </select></td>
		    <?php 
		    //pr($countries );
		    ?>
                    <td>Country</td>
                    <td><select name="Country" id="Country">
                            <option value="" >Select Option</option>
			<?php
			foreach($countries as $key=>$country)
			{
			?>
                            <option value="<?php echo $key ?>" <?php echo (isset($Country) && $Country==$key)?'selected':'';?>><?php echo $country; ?></option>
			<?php
			}
			?>
                        </select></td>
                    <td><input type="submit" name="search" value="Search"></td>
                </tr> 
                 <tr><a href="<?php echo($this->webroot);?>admin/categories/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Category</a>
            </tr>      
            </table>
        </form>
        <?php //echo $this->Form->end();?>
    </div>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('image'); ?></th>
            <th><?php echo $this->Paginator->sort('category_name'); ?></th>
            <th><?php echo $this->Paginator->sort('category_description'); ?></th>
            <th><?php echo $this->Paginator->sort('is_principal'); ?></th>
            <th><?php echo $this->Paginator->sort('country'); ?></th>
            <th><?php echo '# Post'; ?></th>
            <th><?php echo 'Subcategories'; ?></th>
            <th><?php echo $this->Paginator->sort('active'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
	<?php 
        $CatCnt=0;
        foreach ($categories as $category): 
            $CatCnt++;
	//pr($category);
	?>
        <tr>
            <td><?php echo $CatCnt;//echo h($category['Category']['id']); ?>&nbsp;</td>
            <td><img src="<?php echo $this->webroot; ?>/img/cat_img/<?php echo $category['CategoryImage']['0']['originalpath']; ?>" style="height:30px;" /></td>
            <td><?php echo $category['Category']['category_name'];?></td>
            <td><?php echo $category['Category']['category_description'];?></td>
            <td><?php echo h($category['Category']['is_principal']==1?'Yes':'No'); ?>&nbsp;</td>
            <td><?php echo h($category['Country']['name']); ?>&nbsp;</td>
            <td><?php echo count($category['Post']); ?>&nbsp;</td>
            <td><?php echo count($category['Children']); ?>&nbsp;</td>
            <td><?php if($category['Category']['status']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>
            <td>
            <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')),
                        array('action' => 'view', $category['Category']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
            <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $category['Category']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
            <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $category['Category']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?>
        </td>
        </tr>
<?php endforeach; ?>
    </table>
    <p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
    <div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
    </div>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
