<div class="privacies index">
	<h2><?php echo __('Sitemap'); ?></h2>
	<table cellpadding="0" cellspacing="0">

		<tr><a href="<?php echo($this->webroot);?>admin/Sitemaps/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New SEO Sitemap</a>
            </tr> 
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php foreach ($sitemaps as $value): ?>
	<tr>
		<td><?php echo h($value['Sitemap']['id']); ?></td>
		<td><?php echo h($value['Sitemap']['title']); ?></td>
		<!--<td>
			<?php echo $this->Html->link($privacy['User']['id'], array('controller' => 'users', 'action' => 'view', $privacy['User']['id'])); ?>
		</td>!-->
		<td><?php echo h($value['Sitemap']['description']); ?></td>
		<td><?php echo h($value['Sitemap']['status']== 1) ? 'Active' : 'Deactive'; ?></td>
		<td>
			<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $value['Sitemap']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
			<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $value['Sitemap']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $value['Sitemap']['id'])); ?>
		<!--	<?php echo $this->Html->link(__('View'), array('action' => 'view', $privacy['Sitemap']['id'])); ?>!-->
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
	