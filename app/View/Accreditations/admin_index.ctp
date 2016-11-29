<?php //pr($accreditations); ?>
<div class="faqs index">
    <h2><?php echo __('Accreditation'); ?></h2>
    <table style="width:100%;border:0px solid red;">
         
        <table cellpadding="0" cellspacing="0">

   
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('accreditation_id'); ?></th>
                <th><?php echo $this->Paginator->sort('title'); ?></th>
                <th><?php echo $this->Paginator->sort('description'); ?></th>
                <th><?php echo $this->Paginator->sort('as_a_provider'); ?></th>
                <th><?php echo $this->Paginator->sort('training_courses'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
	<?php
        if(!empty($accreditations)) :
            foreach ($accreditations as $key => $accreditation) :
        ?>
                <tr>
                    <td>
                        <?php
                        echo ++$key;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo h($accreditation['AccreditationList']['title']);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo h(strip_tags($accreditation['Accreditation']['title']));
                        ?></td>
                    <td>
                        <?php
                        echo ($accreditation['Accreditation']['as_a_provider'] == 1) ? 'Active' : 'Deactive';
                        ?>
                    </td>
                    <td>
                        <?php
                        echo ($accreditation['Accreditation']['training_courses'] == 1) ? 'Active' : 'Deactive';
                        ?>
                    </td>
                    <td>
                        <?php
                        echo h($accreditation['Accreditation']['description']);
                        ?>
                    </td>
                    <td >
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')),
                        array('action' => 'view', $accreditation['Accreditation']['id']),
                        array('class' => 'btn btn-success btn-xs', 'escape'=>false)); ?>
                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $accreditation['Accreditation']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
                            <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $accreditation['Accreditation']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $accreditation['Accreditation']['id'])); ?>
                    </td>
                </tr>
        <?php
            endforeach;
        else :
        ?>
            <tr>
                <td colspan="6"><?php echo __('No accreditation found'); ?></td>
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