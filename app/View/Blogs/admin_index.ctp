<div class="categories index">
	<h2><?php echo __('Blogs'); ?></h2>
	<!--<a href="<?php echo $this->webroot.'admin/categories/export'; ?>" style="float:right">Export Categories</a>-->
        <table style="width:100%;border:0px solid red;">
            <tr>
                    <td style="width:70%;border:0px solid red;">&nbsp;</td>
                    <td style="width:30%;border:1px dashed #ccc;text-align:center"><a href="<?php echo($this->webroot);?>admin/blogs/add">Add New Blog</a></td>
            </tr>
        </table>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title', 'Blog Title'); ?></th>
                        <th><?php echo $this->Paginator->sort('cat_id', 'Category'); ?></th>
			<th><?php echo $this->Paginator->sort('active', 'Status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($blog_list as $blog): ?>
	<tr>
		<td><?php echo h($blog['Blog']['id']); ?>&nbsp;</td>
		<td><?php echo h($blog['Blog']['title']); ?>&nbsp;</td>
                <td><?php echo h($blog['Category']['name']); ?>&nbsp;</td>
		<td><?php echo h($blog['Blog']['status']==1?'Active':'Inactive'); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $blog['Blog']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $blog['Blog']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $blog['Blog']['id']), null, __('Are you sure you want to delete # %s?', $blog['Blog']['id'])); ?>
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
