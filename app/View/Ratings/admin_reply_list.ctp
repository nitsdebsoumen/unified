<?php
/*echo '<pre>';
print_r($review_all);
echo '</pre>';*/
?>
<div class="span9" id="content">
	<div class="row-fluid">
		<!-- block -->
		<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left"><?php echo __('Reply'); ?></div>
				
			</div>
			<div class="block-content collapse in">
				<div class="span12">
					<table class="table table-hover">
					<thead>
					<tr>
						<th>Company Name</th>
						<th><?php echo $this->Paginator->sort('reply_on', 'Post Date'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php 
					//print_r($review_all);
                                        //echo 
                                        //if(isset($review_all) && count($review_all)>0){
                                        foreach ($review_all as $review): ?>
					<tr>
						<td><?php echo h($review['Spa']['title']); ?>&nbsp;</td>
						<td><?php echo isset($review['ReviewReply']['reply_on'])?date('M dS, Y', strtotime($review['ReviewReply']['reply_on'])):'';?>&nbsp;</td>
						<td class="actions">
							<a href="<?php echo $this->webroot;?>admin/ratings/reply_edit/<?php echo $review['ReviewReply']['id'];?>"><img src="<?php echo $this->webroot;?>img/edit.png" title="Edit reply" width="22" height="21"></a>

							<a href="<?php echo $this->webroot;?>admin/ratings/reply_delete/<?php echo $review['ReviewReply']['id'];?>" onclick="return confirm('Are you sure to delete this reply?')"><img src="<?php echo $this->webroot;?>img/delete.png" title="Delete reply" width="24" height="24"></a>
						</td>
					</tr>
					<?php endforeach; 
                                        //}
                                        ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /block -->
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
</div>
<style>
.actions a
{
 background:none;
 border:none;
 border-radius:0px;
 box-shadow:none;
 padding:0px;
}
</style>