<div class="faqs index">
    <h2><?php echo __('Home Sliders'); ?></h2>
    <table style="width:100%;border:0px solid red;">
         <tr>
            <td style="width:70%;border:0px solid red;">&nbsp;</td>
        <a href="<?php echo($this->webroot);?>admin/homesliders/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Home Slider</a>  
        </tr>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('image'); ?></th>
                <th><?php echo $this->Paginator->sort('title'); ?></th>
                <th><?php echo $this->Paginator->sort('description'); ?></th>
                <th><?php echo $this->Paginator->sort('status'); ?></th>
                <th><?php echo $this->Paginator->sort('order'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
	<?php
        if(!empty($homesliders)) :
            foreach ($homesliders as $key => $homeslider) :
        ?>
            <tr>
                <td>
                    <?php
                    echo ++$key;
                    ?>
                </td>
                <td>
                    <?php
                    $uploadFolder = "homeslider/";
                    $uploadPath = $this->webroot . $uploadFolder;
                    ?>
                    <img src="<?php echo ($homeslider['Homeslider']['image'] != '') ? $uploadPath . $homeslider['Homeslider']['image'] : ''; ?>" width="100" />
                </td>
                <td>
                    <?php
                    echo h($homeslider['Homeslider']['title']);
                    ?>
                </td>
                <td>
                    <?php
                    echo h($homeslider['Homeslider']['desc']);
                    ?>
                </td>
                <td>
                    <?php
                    echo ($homeslider['Homeslider']['status'] == 1) ? 'Active' : 'Deactive';
                    ?>
                </td>
                <td>
                    <?php
                    echo h($homeslider['Homeslider']['order']);
                    ?>
                </td>
                <td>
                            <?php //echo $this->Html->link(__('View'), array('action' => 'view', $homeslider['Homeslider']['id'])); ?>
                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $homeslider['Homeslider']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>

                            <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $homeslider['Homeslider']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $homeslider['Homeslider']['id'])); ?>
                </td>
            </tr>
        <?php
            endforeach;
        else :
        ?>
            <tr>
                <td colspan="7"><?php echo __('No Homeslider found'); ?></td>
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