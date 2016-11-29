<div class="faqs index">
    <h2><?php echo __('FAQS'); ?></h2>
    <table style="width:100%;border:0px solid red;">
         
        <table cellpadding="0" cellspacing="0">

            <tr>
            <td style="width:10%;border:0px solid red;">&nbsp;</td>
<a href="<?php echo($this->webroot);?>admin/trainingproviders/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Training Provider</a>  
        </tr>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('title'); ?></th>
                <th><?php echo $this->Paginator->sort('description'); ?></th>
                <th><?php echo $this->Paginator->sort('status'); ?></th>
                <th><?php echo $this->Paginator->sort('order'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
	<?php
        if(!empty($faqs)) :
            foreach ($faqs as $key => $faq) :
        ?>
                <tr>
                    <td>
                        <?php
                        echo ++$key;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo h($faq['Faq']['title']);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo h(strip_tags($faq['Faq']['description']));
                        ?></td>
                    <td>
                        <?php
                        echo ($faq['Faq']['status'] == 1) ? 'Active' : 'Deactive';
                        ?>
                    </td>
                    <td>
                        <?php
                        echo h($faq['Faq']['order']);
                        ?>
                    </td>
                    <td >
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')),
                        array('action' => 'view', $faq['Faq']['id']),
                        array('class' => 'btn btn-success btn-xs', 'escape'=>false)); ?>
                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $faq['Faq']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
                            <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $faq['Faq']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $faq['Faq']['id'])); ?>
                    </td>
                </tr>
        <?php
            endforeach;
        else :
        ?>
            <tr>
                <td colspan="6"><?php echo __('No faq found'); ?></td>
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