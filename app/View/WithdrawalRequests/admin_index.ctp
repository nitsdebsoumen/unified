<?php //pr($WithdrawalRequests); exit;?>
<style>
th {
	text-align: center;
}
.btn-xs{
	margin-left: 34%;	
}
</style>

<div class="orders index">
	<h2><?php echo __('Cash Withdrawal Requests'); ?></h2>
	  <table style="width:100%;border:0px solid red;">
         <tr>
            <td style="width:70%;border:0px solid red;">&nbsp;</td>
        <!-- <a href="<?php echo($this->webroot);?>admin/membership_orders/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Membership Orders</a>   -->
        </tr>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('total_fund');?></th>
			<th><?php echo $this->Paginator->sort('requested_fund');?></th>
			<th><?php echo $this->Paginator->sort('bank_account'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions" style="color:#65CEA7;" ><?php echo __('Actions'); ?></th>
	</tr>
	<?php $UserCnt=0;
	 foreach ($WithdrawalRequests as $WithdrawalRequest): 
	 $UserCnt++; ?>
	<tr>
		<td><?php echo $UserCnt; ?></td>
		<td>
			<?php echo $this->Html->link($WithdrawalRequest['User']['first_name'].' '.$WithdrawalRequest['User']['last_name'], array('controller' => 'users', 'action' => 'view', $WithdrawalRequest['User']['id'])); ?>
		</td>
		<td>&nbsp;<?php echo $WithdrawalRequest['WithdrawalRequest']['total_fund']; ?>&nbsp;</td>
		<td>&nbsp;<?php echo $WithdrawalRequest['WithdrawalRequest']['requested_fund']; ?>&nbsp;</td>
		<td>&nbsp;<?php echo $WithdrawalRequest['WithdrawalRequest']['bank_account']; ?>&nbsp;</td>
		<td>&nbsp;<?php if($WithdrawalRequest['WithdrawalRequest']['status']==0) { ?> <img style="height:30px;" src="<?php echo $this->webroot;?>img/cross-512.png"><?php } else { ?> <img style="height:30px;" src="<?php echo $this->webroot;?>img/success-01-128.png"> <?php } ?>&nbsp;</td>
		<td>
			        	<!--<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $Membership_Order['WithdrawalRequest']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>

                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')),
                        array('action' => 'view', $Membership_Order['WithdrawalRequest']['id']),
                        array('class' => 'btn btn-success btn-xs', 'escape'=>false)); ?>-->

                            <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $WithdrawalRequest['WithdrawalRequest']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $WithdrawalRequest['WithdrawalRequest']['id'])); ?>
			<?php if($WithdrawalRequest['WithdrawalRequest']['status']==0) { ?>
                        <button type="button" class="btn btn-default make_feature" data-rid="<?php echo $WithdrawalRequest['WithdrawalRequest']['id'];?>" data-amount="<?php echo $WithdrawalRequest['WithdrawalRequest']['requested_fund'];?>" data-id="<?php echo $WithdrawalRequest['User']['id'];?>">Make Activate Withdrawal</button>
                        <?php } ?>
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
        var rid = $(this).data('rid');
        var amunt = $(this).data('amount');
        

        $.ajax({
                url: "<?php echo $this->webroot;?>withdrawal_requests/ajaxActivateWithdrawal",
                type:'POST',
                dataType:'json',
                data:{user_id:uid,amount:amunt,request_id:rid},
                success: function(result){
                    if(result.ack == '1' || result.ack == '0'){
                    	location.reload();
                    }

                }
        }); 

    });
});
</script>