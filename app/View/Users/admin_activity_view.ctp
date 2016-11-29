<div class="categories index">
	<h2><?php echo __('Activity List'); ?></h2>
	<!--<a href="<?php echo $this->webroot.'admin/users/activity_export'; ?>" style="float:right">Export Activity</a>-->
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Zip code</th>
			<th><?php echo $this->Paginator->sort('ip'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<!--<th class="actions"><?php echo __('Actions'); ?></th>-->
	</tr>
	<?php 
        $ActvCnt=0;
        foreach($activity_list as $activity): 
            $ActvCnt++;?>
	<tr>
		<td><?php echo h($activity['Activity']['id']); ?>&nbsp;</td>
		<td><?php echo $activity['User']['first_name'];?>&nbsp;<?php echo $activity['User']['last_name'];?>&nbsp;</td>
                <td><?php echo h($activity['User']['email']); ?>&nbsp;</td>
                <td><?php echo h($activity['User']['phone_no']); ?>&nbsp;</td>
                <td><?php echo h($activity['User']['zipcode']); ?>&nbsp;</td>
                <td><?php echo h($activity['Activity']['ip']); ?>&nbsp;</td>
                <td><?php echo h($activity['Activity']['date']); ?>&nbsp;</td>
		<!--<td class="actions">
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?>
		</td>-->
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
