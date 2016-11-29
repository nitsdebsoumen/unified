<style>
    table tr td { text-align: left; }
</style>
<div class="partners index">
    <h2><?php echo __('Partners'); ?></h2>
    <table style="width:100%;border:0px solid red;">
        <tr>
            <td colspan="6">
                <a href="<?php echo($this->webroot);?>admin/partners/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Partner</a>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo $this->Paginator->sort('id'); ?>
            </th>
            <th>
                <?php echo $this->Paginator->sort('image'); ?>
            </th>
            <th>
                <?php echo $this->Paginator->sort('name'); ?>
            </th>
            <th>
                <?php echo $this->Paginator->sort('desc', 'Description'); ?>
            </th>
            <th>
                <?php echo $this->Paginator->sort('status'); ?>
            </th>
            <th class="actions">
                <?php echo __('Actions'); ?>
            </th>
        </tr>
	<?php
        if(!empty($partners)) :
            foreach ($partners as $key => $partner) :
        ?>
        <tr>
            <td>
                    <?php
                    echo ++$key;
                    ?>
            </td>
            <td>
                    <?php
                    $uploadFolder = "partners/";
                    $uploadPath = $this->webroot . $uploadFolder;
                    ?>
                <img src="<?php echo ($partner['Partner']['image'] != '') ? $uploadPath . $partner['Partner']['image'] : ''; ?>" width="100" />
            </td>
            <td>
                    <?php
                    echo h($partner['Partner']['name']);
                    ?>
            </td>
            <td>
                    <?php
                    echo substr(strip_tags($partner['Partner']['desc']), 0, 100);
                    ?>
            </td>
            <td>
                    <?php
                    echo ($partner['Partner']['status'] == 1) ? 'Active' : 'Deactive';
                    ?>
            </td>
            <td >
                <?php //echo $this->Html->link(__('View'), array('action' => 'view', $banner['Banner']['id'])); ?>
                <?php
                echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $partner['Partner']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false));
                ?>

                <?php
                echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                array('action' => 'delete', $partner['Partner']['id']),
                array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                __('Are you sure you want to delete # %s?', $partner['Partner']['id']));
                ?>
            </td>
        </tr>
        <?php
            endforeach;
        else :
        ?>
        <tr>
            <td colspan="6"><?php echo __('No Partner found'); ?></td>
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