<style>
    table tr td { text-align: left; }
</style>
<div class="adminroles index">
    <h2><?php echo __('Admin Roles'); ?></h2>

<!--    <a href="<?php echo($this->webroot);?>admin/adminroles/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Adminrole</a>-->


    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
	<?php
        if(!empty($adminroles)) :
            foreach ($adminroles as $key => $adminrole) :
        ?>
        <tr>
            <td>
                <?php
                echo ++$key;
                ?>
            </td>
            <td>
                <?php
                echo h($adminrole['Adminrole']['name']);
                ?>
            </td>
            <td>
                <?php
                echo $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $adminrole['Adminrole']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false));
                
//                echo $this->Form->postLink(
//                        $this->Html->tag('i', '', array('class' => 'fa fa-times')),
//                        array('action' => 'delete', $adminrole['Adminrole']['id']),
//                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
//                        __('Are you sure you want to delete # %s?', $adminrole['Adminrole']['id']));
                ?>
            </td>
            <!--<td class="actions">
                
                <?php //echo $this->Html->link(__('View'), array('action' => 'view', $adminrole['Adminrole']['id'])); ?>
                <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $adminrole['Adminrole']['id'])); ?>
                <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $adminrole['Adminrole']['id']), null, __('Are you sure you want to delete # %s?', $adminrole['Adminrole']['id'])); ?>
            </td>-->
        </tr>
        <?php
            endforeach;
        else :
        ?>
        <tr>
            <td colspan="7"><?php echo __('No Adminrole found'); ?></td>
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