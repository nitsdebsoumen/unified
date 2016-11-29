<div class="privacies index">
	<h2><?php echo __('Analytics'); ?></h2>
	<table cellpadding="0" cellspacing="0">

<tr><a href="<?php echo($this->webroot);?>admin/Analytics/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New SEO Analytic</a>
            </tr>

	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php foreach ($analytics as $value): ?>
	<tr>
		<td><?php echo h($value['Analytic']['id']); ?></td>
		<td><?php echo h($value['Analytic']['title']); ?></td>
		<!--<td>
			<?php echo $this->Html->link($privacy['User']['id'], array('controller' => 'users', 'action' => 'view', $privacy['User']['id'])); ?>
		</td>!-->
		<td><?php echo h($value['Analytic']['description']); ?></td>
		<td><?php echo h($value['Analytic']['status']== 1) ? 'Active' : 'Deactive'; ?></td>
		<td>
		<!--	<?php echo $this->Html->link(__('View'), array('action' => 'view', $privacy['Analytic']['id'])); ?>!-->
			<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $value['Analytic']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
			<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $value['Analytic']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $value['Analytic']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<?php echo $this->webroot;?>