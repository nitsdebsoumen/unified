<div class="contents index">
	<h2 style="width:100%;float:left;"><?php echo __('Featured Plans'); ?></h2>
<!--	<a href="<?php echo $this->webroot.'admin/cms_page/add'; ?>" style="float:right">Content Add</a>-->

	<table cellpadding="0" cellspacing="0">
		<tr><a href="<?php echo($this->webroot);?>admin/FeaturedPlans/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Featured Plan</a>
            </tr>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
		
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('duration'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($contents as $content): ?>
	<tr>
		<td><?php echo h($content['FeaturedPlan']['id']); ?>&nbsp;</td>
		<td><?php echo h($content['FeaturedPlan']['title']); ?>&nbsp;</td>
	
		<td><?php echo ($content['FeaturedPlan']['price']);?></td>
		<td><?php echo ($content['FeaturedPlan']['duration']);?> Days</td>
		<td>
			<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')),
                        array('action' => 'view', $content['FeaturedPlan']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
			<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $content['FeaturedPlan']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
		    <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $content['FeaturedPlan']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $content['FeaturedPlan']['id'])); ?>
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