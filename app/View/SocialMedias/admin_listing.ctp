<div class="privacies index">
	<h2><?php echo __('Social Media'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr><a href="<?php echo($this->webroot);?>admin/SocialMedias/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Social Media</a>
            </tr>
		 <?php
                    $uploadFolder = "social_media_icon/";
                    $uploadPath = $this->webroot . $uploadFolder;
                    ?>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('icon');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
if (!empty($socialmedias)) {


	 foreach ($socialmedias as $value): ?>
	<tr>
		<td><?php echo h($value['SocialMedia']['id']); ?></td>
		<td><?php echo h($value['SocialMedia']['title']); ?></td>
		<!--<td>
			<?php echo $this->Html->link($privacy['User']['id'], array('controller' => 'users', 'action' => 'view', $privacy['User']['id'])); ?>
		</td>!-->
		<td><?php echo h($value['SocialMedia']['url']); ?></td>
		<td><?php echo h($value['SocialMedia']['status']== 1) ? 'Active' : 'Deactive'; ?></td>
		<td>
		<img src="<?php echo $this->webroot;?>/social_media_icon/<?php echo h($value['SocialMedia']['icon']);?> " alt="" style="height: 41px;"></td>
		
		<!--	<?php echo $this->Html->link(__('View'), array('action' => 'view', $privacy['Analytic']['id'])); ?>!-->

		<td>

			<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $value['SocialMedia']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
			<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $value['SocialMedia']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $value['SocialMedia']['id'])); ?>
		<!--	<?php echo $this->Html->link(__('View'), array('action' => 'view', $privacy['Analytic']['id'])); ?>!-->
			
		</td>
			
	</tr>
<?php endforeach; }
else {
	echo "<tr><td colspan='5'>Nothing Found </td> </tr>";
} ?>
	</table>
</div>
