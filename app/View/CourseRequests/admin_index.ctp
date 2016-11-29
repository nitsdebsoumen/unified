<?php
//pr($courseRequests);
?>
<div class="course_request index">
    <h2><?php echo __('Course Request'); ?></h2>
    <table style="width:100%;border:0px solid red;">
         
        <table cellpadding="0" cellspacing="0">

            
            <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th>User Name</th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
	<?php
        if(!empty($courseRequests)) :
            foreach ($courseRequests as $key => $courseRequest) :
        ?>
                <tr>
                    <td>
                        <?php
                        echo ++$key;
                        ?>
                    </td>
                    <td>
                        <a class="btn btn-info btn-xs" href="<?php echo $this->Html->url('/'); ?>admin/posts/edit/<?php echo $courseRequest['Post']['id']; ?>"><?php
                        echo h($courseRequest['Post']['post_title']);
                        ?></a>
                    </td>
                    <td><a href="<?php echo $this->Html->url('/'); ?>admin/users/view/<?php echo $courseRequest['User']['id']; ?>">
                                   <?php
                        echo $courseRequest['User']['first_name'] . ' ' . $courseRequest['User']['last_name'];
                        ?></a>
                    </td>
                    
                    <td >
                      
                        <a class="btn btn-info btn-xs" href="<?php echo $this->Html->url('/'); ?>admin/posts/edit/<?php echo $courseRequest['Post']['id']; ?>"><i class="fa fa-check"></i></a>
                          <?php
                        //echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-check')),
                        //array('action' => 'Post', $courseRequest['Post']['id']),
                        //array('class' => 'btn btn-success btn-xs', 'escape'=>false));
                                                
                        echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $courseRequest['CourseRequest']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $courseRequest['Post']['post_title']));
                        ?>
                            
                    </td>
                </tr>
        <?php
            endforeach;
        else :
        ?>
            <tr>
                <td colspan="6"><?php echo __('No course found'); ?></td>
            </tr>
        <?php
        endif;
        ?>
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
<?php //echo($this->element('admin_sidebar'));?>