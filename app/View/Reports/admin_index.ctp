<style>
th,td{
	text-align: center;
}
</style>
<div class="orders index">
	<h2><?php echo __('Reports'); ?></h2>
	  <table style="width:100%;border:0px solid red;">
         <tr>
          <form method="post" action="">
          <button class="btn btn-primary pull-right" id="download_csv" name="downloadcsv" type="submit">Download CSV</button>
          </form>  
        </tr>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo 'Sl.No'; ?></th>
			<th><?php echo 'Course Title';?></th>
			<th><?php echo 'course Price';?></th>
			<th><?php echo 'Total Order';?></th>
			<th><?php echo 'Total Reveneu' ?></th>
						
	</tr>
	<?php 
	$count=1;
	foreach ($all_orders as $order): ?>
	<tr>
		<td><?php echo $count; ?></td>
		<td>
			<?php echo $order['Post']['post_title']; ?>
		</td>
		
		<td>$&nbsp;<?php echo $order['Post']['price']; ?>&nbsp;</td>
		<td>&nbsp;<?php echo $order[0]['sum']; ?>&nbsp;</td>
		<td>$&nbsp;<?php echo $order['Post']['price']*$order[0]['sum']; ?>&nbsp;</td>
		
	</tr>
    <?php 
    $count=$count+1;
    endforeach; ?>
	</table>
	<!-- <p>
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
	</div> -->
</div>
<?php //echo $this->element('admin_sidebar'); ?>