<?php
//pr($posts);

?>
<div class="categories index">
    <h2><?php echo __('Courses'); ?></h2>
    <div>
       <?php //echo $this->Form->create("User");?>
        <form name="Searchuserfrm" method="post" action="" id="Searchuserfrm" style="width: 100%;">
            <table style=" border:none;">
                <tr>
                    <td colspan="7">
                        <a href="<?php echo($this->webroot);?>admin/posts/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Courses</a>
                    </td>
                </tr>
                <tr>
                    <td>Keyword</td>
                    <td><input type="text" name="keyword" value="<?php echo isset($keywords)?$keywords:'';?>" placeholder="Search by Keyword."></td>
                    <td>Activity Status</td>
                    <td>
                        <select name="search_is_active" id="search_is_active">
                            <option value="" >Select Option</option>
                            <option value="1" <?php echo (isset($Newsearch_is_active) && $Newsearch_is_active=='1')?'selected':'';?>>Approve</option>
                            <option value="0" <?php echo (isset($Newsearch_is_active) && $Newsearch_is_active=='0')?'selected':'';?>>Disapprove</option>
                        </select>
                    </td>
                    <td>User By</td>
                    <td>
                        <select name="user" id="user">
                            <option value="" >Select Option</option>
                            <?php
                            foreach($users as $key=>$user)
                            {
                            ?>
                                <option value="<?php echo $key ?>" <?php echo (isset($User) && $User==$key)?'selected':'';?>><?php echo $user; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="submit" name="search" value="Search" />
                    </td>
                </tr>
            </table>
        </form>
        <?php //echo $this->Form->end();?>
    </div>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('image'); ?></th>
            <th><?php echo $this->Paginator->sort('provider_name'); ?></th>
            <th><?php echo $this->Paginator->sort('post_title', 'Course Title'); ?></th>
            <th><?php echo $this->Paginator->sort('post_description', 'Course Description'); ?></th>
            <th><?php echo $this->Paginator->sort('is_approve'); ?></th>
            <th><?php echo $this->Paginator->sort('featured'); ?></th>
            <th><?php echo $this->Paginator->sort('is_show_home_page'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id','Posted By'); ?></th>
            <th><?php echo $this->Paginator->sort('category_id', 'Course Category'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
	<?php
        $CatCnt=0;
        foreach ($posts as $post):
            $CatCnt++;
	//pr($category);

        //echo '<pre>',print_r($post);
        //die();

        $user_logo="";
        if($post['User']['user_logo']!='')
        {
            $user_logo = $this->webroot."user_logo/".$post['User']['user_logo'];
            
        }
        else
        {
            $user_logo = $this->webroot."images/no_image.png";   
        }

	?>
        <tr>
            <td><?php echo $CatCnt;//echo h($category['Category']['id']); ?>&nbsp;</td>
            <td>
                    <?php if($user_logo!="")
                    { ?>
                <img src="<?php echo $user_logo; ?>" style="height:30px;" />
                        <?php
                    } ?>
            </td>
            <td>
                <?php echo $post['User']['first_name'].' '.$post['User']['last_name'];?>
            </td>
            <td><?php echo $post['Post']['post_title'];?></td>
            <td><?php echo $post['Post']['post_description'];?></td>
            <td><?php if($post['Post']['is_approve']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>
            <td><?php if($post['Post']['featured']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>
            <td><?php if($post['Post']['is_show_home_page']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>
            <td><a href="<?php echo $this->Html->url('/'); ?>admin/users/view/<?php echo $post['User']['id']; ?>"><?php echo h($post['User']['first_name']); ?>&nbsp;</a></td>
            <td><a href="<?php echo $this->Html->url('/'); ?>admin/categories/view/<?php echo $post['Category']['id']; ?>"><?php echo h($post['Category']['category_name']); ?>&nbsp;</a></td>
        <!--    <td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?',$post['Post']['id'])); ?>
            </td> -->
            <td >
                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')),
                array('action' => 'view', $post['Post']['id']),
                array('class' => 'btn btn-success btn-xs', 'escape'=>false)); ?>
                    <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                array('action' => 'edit', $post['Post']['id']),
                array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
                    <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                array('action' => 'delete', $post['Post']['id']),
                array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
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
