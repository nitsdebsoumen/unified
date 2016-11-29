<div class="adminroles index">
    <h2><?php echo __('Privilege'); ?></h2>

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
                        array('action' => 'setprivilege', $adminrole['Adminrole']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false));
                ?>
            </td>
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
