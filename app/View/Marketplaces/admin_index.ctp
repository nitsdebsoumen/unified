<div class="categories index">
	<h2><?php echo __('Posts'); ?></h2>
	        <div>
       <?php //echo $this->Form->create("User");?>
            <form name="Searchuserfrm" method="post" action="" id="Searchuserfrm">   
        <table style=" border:none;">
            <tr>
                <td>Name</td>
                <td><input type="text" name="keyword" value="<?php echo isset($keywords)?$keywords:'';?>" placeholder="Search by Keyword."></td>
                <td>Activity Status</td>
                <td><select name="search_is_active" id="search_is_active">
                        <option value="" >Select Option</option>
                        <option value="1" <?php echo (isset($Newsearch_is_active) && $Newsearch_is_active=='1')?'selected':'';?>>Approve</option>
                        <option value="0" <?php echo (isset($Newsearch_is_active) && $Newsearch_is_active=='0')?'selected':'';?>>Disapprove</option>
                    </select></td>
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
        </table>
            </form>
        <?php //echo $this->Form->end();?>
        </div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('image'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('is_approve'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id','Marketplace User'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id','Marketplace Category'); ?></th>
			<th><?php echo $this->Paginator->sort('country_id','Marketplace Country'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php 
        $CatCnt=0;
        foreach ($posts as $post): 
            $CatCnt++;
	//pr($category);
	?>
	<tr>
		<td><?php echo $CatCnt;//echo h($category['Category']['id']); ?>&nbsp;</td>
		<td><img src="<?php echo $this->webroot; ?>/img/marketplace_img/<?php echo $post['MarketplaceImage']['0']['originalpath']; ?>" style="height:30px;" /></td>
		<td><?php echo $post['Marketplace']['title'];?></td>
		<td><?php echo $post['Marketplace']['description'];?></td>
		<td><?php if($post['Marketplace']['is_approve']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>
		<td><a href="http://107.170.152.166/team4/niwi/admin/users/view/<?php echo $post['User']['id']; ?>"><?php echo h($post['User']['first_name']); ?>&nbsp;</a></td>
		<td><a href="http://107.170.152.166/team4/niwi/admin/categories/view/<?php echo $post['Category']['id']; ?>"><?php echo h($post['Category']['category_name']); ?>&nbsp;</a></td>
		<td><?php echo h($post['Country']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Marketplace']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Marketplace']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Marketplace']['id']), null, __('Are you sure you want to delete # %s?',$post['Marketplace']['id'])); ?>
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
