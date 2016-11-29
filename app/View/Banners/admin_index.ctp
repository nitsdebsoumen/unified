<div class="faqs index">
    <h2><?php echo __('Banners'); ?></h2>
    <table style="width:100%;border:0px solid red;">
        <tr>
            <td style="width:70%;border:0px solid red;">&nbsp;</td>
            <td ><a href="<?php echo($this->webroot);?>admin/banners/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New BAnner</a>  
        </tr></td>
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
        if(!empty($banners)) :
            foreach ($banners as $key => $banner) :
        ?>
            <tr>
                <td>
                    <?php
                    echo ++$key;
                    ?>
                </td>
                <td>
                    <?php
                    $uploadFolder = "banner/";
                    $uploadPath = $this->webroot . $uploadFolder;
                    ?>
                    <img src="<?php echo ($banner['Banner']['image'] != '') ? $uploadPath . $banner['Banner']['image'] : ''; ?>" width="100" />
                </td>
                <td>
                    <?php
                    echo h($banner['Banner']['title']);
                    ?>
                </td>
                <td>
                    <?php
                    echo h($banner['Banner']['desc']);
                    ?>
                </td>
                <td>
                    <?php
                    echo ($banner['Banner']['status'] == 1) ? 'Active' : 'Deactive';
                    ?>
                </td>
                <td>
                    <?php
                    echo h($banner['Banner']['order']);
                    ?>
                </td>
                <td >
                            <?php //echo $this->Html->link(__('View'), array('action' => 'view', $banner['Banner']['id'])); ?>
                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $banner['Banner']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
                            
                            <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $banner['Banner']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $banner['Banner']['id'])); ?>
                </td>
            </tr>
        <?php
            endforeach;
        else :
        ?>
            <tr>
                <td colspan="7"><?php echo __('No Banner found'); ?></td>
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