<?php 
#pr($categories);
?>
<div class="categories index">
	<h2><?php echo __('Sub Categories of'); ?>&nbsp;<?php echo($categoryname);?></h2>
	<a href="<?php echo $this->webroot.'admin/categories/exportsub/'.$id; ?>" style="float:right">Export Categories</a>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($categories as $cat){
		if(!empty($cat['Children'])){
		foreach($cat['Children'] as $category){
		if($category['parent_id']==$id){
	?>
	<tr>
		<td><?php echo h($category['id']); ?>&nbsp;</td>
		<!--<td><?php echo ($this->Html->link(__($category['Category']['name']), array('action' => 'subcategories', $category['Category']['id'])));?></td>-->
		<td><?php echo h($category['name']); ?>&nbsp;</td>
		<td><?php echo h($category['active']==1?'Active':'Inactive'); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $category['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['id']), null, __('Are you sure you want to delete # %s?', $category['id'])); ?>
		</td>
	</tr>
	<?php } } } } ?>
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
