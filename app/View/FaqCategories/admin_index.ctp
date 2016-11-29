<div class="categories index">
	<h2><?php echo __('Faq Categories'); ?></h2>
	<table style="width:100%;border:0px solid red;">
	<tr>
		<td style="width:70%;border:0px solid red;">&nbsp;</td>
		<td style="width:30%;border:1px dashed #ccc;text-align:center"><a href="<?php echo($this->webroot);?>admin/faq_categories/add">Add New Faq Category</a></td>
	</tr>
	</table>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php 
	if(isset($faqcategories) && !empty($faqcategories))
	{
            $FaqCnt=0;
            foreach ($faqcategories as $category): 
            $FaqCnt++;?>
	<tr>
		<td><?php echo $FaqCnt;//echo h($category['FaqCategory']['id']); ?>&nbsp;</td>
		<td><?php echo ($category['FaqCategory']['name']);?></td>
		<td><?php echo h($category['FaqCategory']['active']==1?'Active':'Inactive'); ?>&nbsp;</td>
		<td class="actions">
			
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $category['FaqCategory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['FaqCategory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['FaqCategory']['id']), null, __('Are you sure you want to delete # %s?', $category['FaqCategory']['id'])); ?>
		</td>
	</tr>
<?php endforeach; 
	}?>
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
