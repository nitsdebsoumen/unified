<style>
th {
	text-align: center;
}
.btn-xs{
	margin-left: 34%;	
}
</style>

<div class="orders index">
	<h2><?php echo __('Featured Provider Order'); ?></h2>
	  <table style="width:100%;border:0px solid red;">
         <tr>
            <td style="width:70%;border:0px solid red;">&nbsp;</td>
        <!-- <a href="<?php echo($this->webroot);?>admin/membership_orders/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Membership Orders</a>   -->
        </tr>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('membership_plan_id','Featured Provider Plan');?></th>
			<th><?php echo $this->Paginator->sort('transection_id');?></th>
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('billing_address'); ?></th>
			<th><?php echo $this->Paginator->sort('shipping_address'); ?></th>
		    <th class="actions" style="color:#65CEA7;" ><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($MembershipOrders as $Membership_Order): ?>
	<tr>
		<td><?php echo h($Membership_Order['MembershipOrder']['id']); ?></td>
		<td>
			<?php echo $this->Html->link($Membership_Order['User']['first_name'].' '.$Membership_Order['User']['last_name'], array('controller' => 'users', 'action' => 'view', $Membership_Order['User']['id'])); ?>
		</td>
		<td>&nbsp;<?php echo $Membership_Order['MembershipPlan']['title']; ?>&nbsp;</td>
		<td>&nbsp;<?php echo $Membership_Order['MembershipOrder']['transaction_id']; ?>&nbsp;</td>
		<td>&nbsp;<?php echo $Membership_Order['MembershipOrder']['amount']; ?>&nbsp;</td>
		<td>&nbsp;<?php echo $Membership_Order['MembershipOrder']['billing_address'];?>&nbsp;</td>
		<td>&nbsp;<?php echo $Membership_Order['MembershipOrder']['shipping_address'];?>&nbsp;</td>
		 
		<td>
			        	<!--<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $Membership_Order['MembershipOrder']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>

                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')),
                        array('action' => 'view', $Membership_Order['MembershipOrder']['id']),
                        array('class' => 'btn btn-success btn-xs', 'escape'=>false)); ?>-->

                            <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $Membership_Order['MembershipOrder']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $Membership_Order['MembershipOrder']['id'])); ?>
                        <button type="button" class="btn btn-default make_feature" data-id="<?php echo $Membership_Order['User']['id'];?>">Make Feature</button>
                        
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
<script>
$(document).ready(function(){
    $(".make_feature").click(function(){
        var uid = $(this).data('id');
        

        $.ajax({
                url: "<?php echo $this->webroot;?>membership_orders/ajaxFeatureProvider",
                type:'POST',
                dataType:'json',
                data:{user_id:uid},
                success: function(result){
                    if(result.ack == '1' || result.ack == '0'){
                    	alert(result.res);
                    }

                }
        }); 

    });
});
</script>