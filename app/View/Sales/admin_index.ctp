<div class="categories index">
	<h2><?php echo __('Sale'); ?></h2>
	        <div>
       <?php //echo $this->Form->create("User");?>
<!--            <form name="Searchuserfrm" method="post" action="" id="Searchuserfrm">   
        <table style=" border:none;">
            <tr>
                <td>Keyword</td>
                <td><input type="text" name="keyword" value="<?php echo isset($keywords)?$keywords:'';?>" placeholder="Search by Keyword."></td>
                <td>Activity Status</td>
                <td><select name="search_is_active" id="search_is_active">
                        <option value="" >Select Option</option>
                        <option value="1" <?php echo (isset($Newsearch_is_active) && $Newsearch_is_active=='1')?'selected':'';?>>Approve</option>
                        <option value="0" <?php echo (isset($Newsearch_is_active) && $Newsearch_is_active=='0')?'selected':'';?>>Disapprove</option>
                    </select></td>
		    	                    <td>User By</td>
                <td><select name="user" id="user">
                        <option value="" >Select Option</option>
			<?php
			foreach($users as $key=>$user)
			{
			?>
                        <option value="<?php echo $key ?>" <?php echo (isset($User) && $User==$key)?'selected':'';?>><?php echo $user; ?></option>
			<?php
			}
			?>
                    </select></td>
		    <td><input type="submit" name="search" value="Search"></td>
            </tr>     
        </table>
            </form>-->
        <?php //echo $this->Form->end();?>
        </div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('	user_id','User'); ?></th>
			<th><?php echo $this->Paginator->sort('membership_plan_id','Membership Plan'); ?></th>
			<th><?php echo $this->Paginator->sort('fromdate','From Date'); ?></th>
			<th><?php echo $this->Paginator->sort('todate','To Date'); ?></th>
			<th><?php echo $this->Paginator->sort('renew','Renew'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_method','Payment Method'); ?></th>
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
		<td><a href="http://107.170.152.166/team4/niwi/admin/users/view/<?php echo $post['User']['id']; ?>"><?php echo $post['User']['first_name'];?></a></td>
		<td><a href="http://107.170.152.166/team4/niwi/admin/membership_plans/view/<?php echo $post['MembershipPlan']['id']; ?>"><?php echo $post['MembershipPlan']['title'];?></a></td>
		<td><?php echo $post['Sale']['fromdate'];?></td>
		<td><?php echo $post['Sale']['todate'];?></td>
		<td><?php if($post['Sale']['renew']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>
		<td><?php echo $post['Sale']['payment_method'];?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Sale']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Sale']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Sale']['id']), null, __('Are you sure you want to delete # %s?',$post['Sale']['id'])); ?>
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
