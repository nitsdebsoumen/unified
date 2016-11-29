<div class="categories index">
    <h2><?php echo __('Featured Courses'); ?></h2>




    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('image'); ?></th>
            <th><?php echo $this->Paginator->sort('post_title', 'Course Title'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id', 'Training provider'); ?></th>
            <th><?php echo $this->Paginator->sort('post_description', 'Course Description'); ?></th>
            <th><?php echo $this->Paginator->sort('is_approve'); ?></th>
            <th><?php echo $this->Paginator->sort('featured'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id','Posted By'); ?></th>
            <th><?php echo $this->Paginator->sort('category_id', 'Course Category'); ?></th>
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
            <td>
                    <?php if(!empty($post['PostImage']['0']['originalpath']))
                    { ?>
                <img src="<?php echo $this->webroot; ?>/img/post_img/<?php echo $post['PostImage']['0']['originalpath']; ?>" style="height:30px;" />
                        <?php
                    } ?>
            </td>
            <td><?php echo $post['Post']['post_title'];?></td>
            <td><?php echo $post['User']['first_name']." ".$post['User']['last_name'];?></td>
            <td><?php echo $post['Post']['post_description'];?></td>
            <td><?php if($post['Post']['is_approve']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>
            <td><?php if($post['Post']['featured']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>
            <td><a href="<?php echo $this->Html->url('/'); ?>admin/users/view/<?php echo $post['User']['id']; ?>"><?php echo h($post['User']['first_name']); ?>&nbsp;</a></td>
            <td><a href="<?php echo $this->Html->url('/'); ?>admin/categories/view/<?php echo $post['Category']['id']; ?>"><?php echo h($post['Category']['category_name']); ?>&nbsp;</a></td>
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
