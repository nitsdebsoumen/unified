<?php ?>
<?php echo $this->element('user_menu'); ?>                                                        
<section class="main_body">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                    <?php echo $this->element('user_sidebar'); ?>
            </div>
            <div class="col-md-9">
                <div class="paymnt-wrapper">
                    <div class="row">
                        <form class="form-inline" action="" method="get">
                        <div class="col-md-8 trans-left">
                            <h3>Transaction History <span>
                                    <select class="form-control" name="activity">
                                        <option value=""> Current Activity</option>
                                        <option value="1" <?php echo (isset($activity) && $activity=='1')?'selected="selected"':'';?>> Last Week</option>
                                        <option value="2" <?php echo (isset($activity) && $activity=='2')?'selected="selected"':'';?>> Two Weeks ago</option>
                                        <option value="3" <?php echo (isset($activity) && $activity=='3')?'selected="selected"':'';?>> Last Month</option>
                                    </select>
                                </span>
                            <div class="clearfix"></div>
                            </h3>
                            
                            <div class="row">
                                <div class="col-lg-12" style="margin-top: 20px;">
                                    
                                        <div class="form-group">
                                          <label for="exampleInputName2">From</label>
                                          <input type="text" class="form-control" name="from_date" value="<?php echo isset($from_date)?$from_date:'';?>" id="FromDate" placeholder="From date">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputEmail2">To</label>
                                          <input type="text" class="form-control" value="<?php echo isset($to_date)?$to_date:'';?>" id="ToDate" name="to_date" placeholder="To date">
                                        </div>
                                    
                                </div>

                            </div>

                        </div>
                        <div class="col-md-3 col-md-offset-1">
                                <!--<h4 class="text-right">Balance: $1,4587</h4>-->
                        </div>
                        <div class="col-md-9">
                            <div class="col-lg-12" style="margin-top:10px;">
                                <select class="form-control" id="select_option" name="TransacionsType">
                                    <option value="">All Transacions</option>
                                    <option value="release fund" <?php echo (isset($TransacionsType) && $TransacionsType=='release fund')?'selected="selected"':'';?>>All Credit</option>
                                    <option value="pay amount" <?php echo (isset($TransacionsType) && $TransacionsType=='pay amount')?'selected="selected"':'';?>>All Debit</option>
                                </select>

                                <!--<select class="form-control" id="select_option">
                                   <option>All Freelancers</option>
                                   <option>All Freelancers</option>
                                   <option>All Freelancers</option>
                                   <option>All Freelancers</option>
                                </select>

                                <select class="form-control" id="select_option">
                                   <option>All Clients</option>
                                   <option>All Clients</option>
                                   <option>All Clients</option>
                                   <option>All Clients</option>
                                </select>-->
                                <button type="submit" name="search" value="search" class="btn btn-default btn-md green" style="margin-bottom: 2px;">Go</button>

                            </div>
                        </div>
                        </form>
                        <div class="col-md-3">
                         <div class="row">
                                <!--<div class="col-md-6" style="padding: 0px; margin: 0px;">
                                <a style="font-weight: 700;color:#8ba000;" href="#"><span><img src="http://107.170.152.166/team2/ServiceMarketplace/app/webroot/images/pdf.png" >
                                 Get PDF</span></a>
                                </div>-->
                                <div class="col-md-6" style="padding: 2px 0px; margin: 0px;">
                                <a style="font-weight: 700;color:#8ba000;" href="<?php echo $this->webroot?>users/export_transaction_history"><span><img src="<?php echo($this->webroot);?>images/csv.png" >
                                 Get CSV</span></a>
                                </div>
                         </div>	
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="margin-top: 20px;">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->Paginator->sort('pay_date', 'Date'); ?></th>
                                            <th><?php echo $this->Paginator->sort('type', 'Type'); ?></th>
                                            <th>Description</th>
                                            <th>Errand Post by</th>
                                            <th>Errand Done by</th>
                                            <th><?php echo $this->Paginator->sort('user_amount', 'Amount / Balance'); ?></th>
                                            <th><?php echo $this->Paginator->sort('transaction_id', 'Ref ID'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //pr($notifications);
                                        if(count($payment_notifications)>0){
                                            $TotCredit=0;
                                            $TotDebit=0;
                                            foreach($payment_notifications as $val){
                                                $sitelink = Configure::read('SITE_URL');
                                                $UserProfile_img=isset($val['ByUser']['profile_img'])?$val['ByUser']['profile_img']:'';
                                                $uploadImgPath = WWW_ROOT.'user_images';
                                                if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                                                       $imgLink = $sitelink.'user_images/'.$UserProfile_img;
                                                }else{
                                                       $imgLink = $sitelink.'user_images/default.png';
                                                }
                                        ?>
                                        <tr>
                                            <td><?php echo date("M d,Y",strtotime($val['PaymentHistory']['pay_date']));?></td>
                                            <td><?php if($val['PaymentHistory']['type']=='release fund' || $val['PaymentHistory']['type']=='refund amount'){ echo 'Credit Amount'; $TotCredit+=$val['PaymentHistory']['user_amount'];}else{ echo 'Debit Amount'; $TotDebit+=$val['PaymentHistory']['user_amount'];}?></td>
                                            <td><?php if($val['PaymentHistory']['type']=='refund amount'){ echo 'Refunded amount for';}?> "<?php echo $val['Task']['title'];?>" Fee - Ref ID <?php echo $val['PaymentHistory']['transaction_id'];?>
                                            <?php 
                                            if($val['PaymentHistory']['type']=='release fund'){
                                                echo '<br />Service fee: $'.$val['PaymentHistory']['admin_amount'];
                                                echo '<br />Paypal fee: $'.$val['PaymentHistory']['paypal_fee'];
                                            }
                                            ?>    
                                            </td>
                                            <td><?php echo $username = ($this->requestAction('sent_messages/getUsername/'.$val['Task']['user_id'])); ?><?php //echo $val['ForUser']['first_name'].' '.$val['ForUser']['last_name'];?></td>
                                            <td><?php 
                                            //pr($val);
                                            if($val['PaymentHistory']['type']!='refund amount'){
                                            if($val['PaymentHistory']['type']!='pay amount'){ echo $val['ForUser']['first_name'].' '.$val['ForUser']['last_name'];}else{ echo $val['ByUser']['first_name'].' '.$val['ByUser']['last_name'];} }else{ echo 'Cancel';}?></td>
                                            <td><?php if($val['PaymentHistory']['type']=='release fund' || $val['PaymentHistory']['type']=='refund amount'){echo '($'.$val['PaymentHistory']['user_amount'].')';}else{echo '$'.$val['PaymentHistory']['user_amount'];}?> <?php if($val['PaymentHistory']['payment_status']==1){ echo 'Pending';}?></td>
                                            <td class="green"><?php echo $val['PaymentHistory']['transaction_id'];?></td>
                                        </tr>
                                        <?php
                                            }
                                            echo '<tr><td colspan="4">&nbsp;</td><td colspan="3"><p style="font-weight: bold;">Total Debits&nbsp;: $'.$TotDebit.'</p><p style="font-weight: bold;">Total Credits: ($'.$TotCredit.')</p><p style="font-weight: bold;">Total Earnings: $'.($TotDebit-$TotCredit).'</p></td></tr>';
                                        }else{
                                            echo '<tr> <td colspan="7"><p>No Payment Notification found.</p></td></tr>';
                                        }
                                        
                                        ?>
                                    </tbody>
                                </table>
                                <p>
                                <?php
                                    echo $this->Paginator->counter(array(
                                    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                                    ));
                                    ?>	
                                    </p>
                                    <div class="paging">
                                    <?php
                                            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                                            echo $this->Paginator->numbers(array('separator' => ''));
                                            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                                    ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){       
        $('#FromDate').datepicker({dateFormat: 'yy-mm-dd'});
        $('#ToDate').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>
<style>
.user{
cursor: pointer;
color: #2281b1;
background-repeat: no-repeat;
background-size: 16px;
}
.activity-feed{padding: 18px 0;}
.activity-feed .time {
bottom: 2px;
right: 5px;
color: #9c9c9c;
width:20%;
float:right;
}
.activity-feed .text{width:80%;float:left;}
</style>




