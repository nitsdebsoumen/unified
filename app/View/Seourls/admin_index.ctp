<div class="privacies index">
	<h2><?php echo __('Seo URL'); ?></h2>

	<table cellpadding="0" cellspacing="0">


<tr><a href="<?php echo($this->webroot);?>admin/Seourls/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Seo URL</a>
	<table style="width:100%;border:0px solid red;">
         <tbody><tr>
            <td style="width:70%;border:0px solid red;">&nbsp;</td>
          
        </tr>
        </tbody></table>

	<table>

            </tr>

	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('pageID'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php foreach ($seourls as $value): ?>
	<tr>
		<td><?php echo h($value['Seourl']['id']); ?></td>
		<td><?php echo h($value['Seourl']['pageID']); ?></td>
		<!--<td>
			<?php echo $this->Html->link($privacy['User']['id'], array('controller' => 'users', 'action' => 'view', $privacy['User']['id'])); ?>
		</td>!-->
		<td><?php echo h($value['Seourl']['url']); ?></td>
		
		<td>
		<!--	<?php echo $this->Html->link(__('View'), array('action' => 'view', $privacy['Seourl']['id'])); ?>!-->
			<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $value['Seourl']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
			<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $value['Seourl']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $value['Seourl']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
