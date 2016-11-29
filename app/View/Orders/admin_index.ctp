
<div class="orders index">
	<h2><?php echo __('Orders'); ?></h2>
	  <table style="width:100%;border:0px solid red;">
         <tr>
            <td style="width:70%;border:0px solid red;">&nbsp;</td>
        <a href="<?php echo($this->webroot);?>admin/orders/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Order</a>  
        </tr>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('course_title');?></th>
			<th><?php echo $this->Paginator->sort('course_price');?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('total_amount'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_date'); ?></th> 
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($orders as $order): 
	//pr($order);
	?>
	<tr>
		<td><?php echo h($order['OrderItem']['id']); ?></td>
		<td>
			<?php echo $this->Html->link($order['User']['first_name'].' '.$order['User']['last_name'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
		</td>
		<td>&nbsp;<?php echo $order['Post']['post_title']; ?>&nbsp;</td>
		<td>$&nbsp;<?php echo $order['Post']['price']; ?>&nbsp;</td>
		<td>&nbsp;<?php echo $order['OrderItem']['quantity']; ?>&nbsp;</td>
		<td>$&nbsp;<?php $price=$order['Post']['price']; $qty=$order['OrderItem']['quantity']; $total=$price * $qty; echo $total; ?>&nbsp;</td>
		<td><?php echo h(date('d M, Y',strtotime($order['OrderItem']['payment_date']))); ?>&nbsp;</td> 
		<!--<td class="actions">
			<?php echo $this->Html->link(__('Order Details'), array('controller' => 'order_details','action' => 'index', $order['OrderItem']['id'])); ?>
			<?php
			if($order['OrderItem']['admin_paid']==0)
			{
			?>
			<?php echo $this->Html->link(__('Make Payments'), array('controller' => 'orders','action' => 'paynow', $order['OrderItem']['id'])); ?>
			<?php
			}
			else
			{
			?>
			<?php echo $this->Html->link(__('Payment Details'), array('controller' => 'partnership_details','action' => 'index', $order['OrderItem']['id'])); ?>
			<?php
			}
			?>
		</td>-->
		<td>
			     <?php //echo $this->Html->link(__('View'), array('action' => 'view', $homeslider['Homeslider']['id'])); ?>
                        <!--<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $homeslider['Order']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>-->

						<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $order['OrderItem']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>

                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')),
                        array('action' => 'view', $order['OrderItem']['id']),
                        array('class' => 'btn btn-success btn-xs', 'escape'=>false)); ?>

                            <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $order['OrderItem']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $order['OrderItem']['id'])); ?>
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