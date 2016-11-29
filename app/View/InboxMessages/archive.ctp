<?php ?>
<script type="text/javascript">
function gotoSent()
{
	window.location.href="<?php echo($this->webroot);?>sent_messages/";
}

function gotoCompose()
{
	window.location.href="<?php echo($this->webroot);?>sent_messages/compose";
}

function gotoFlag()
{
	window.location.href="<?php echo($this->webroot);?>inbox_messages/flag";
}

function gotoArchive()
{
	window.location.href="<?php echo($this->webroot);?>inbox_messages/archive";
}

function gotoSpam()
{
	window.location.href="<?php echo($this->webroot);?>inbox_messages/spam";
}

$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    $('#EndDate').datepicker({dateFormat: 'yy-mm-dd'});
});


function set_mark(dsp){
	//alert(dsp);
	$('#marking').val(dsp);
	$('#filter').val();
	$('#form1').submit();
}
</script>
<?php echo $this->element('user_menu'); ?>
<section class="main_body">
    <div class="container">
            <div class="row">
                    <div class="col-md-3">
                            <?php echo $this->element('user_sidebar'); ?>
                    </div>
                    <div class="col-md-9 whit_bg">
                        <div class="right_dash_board">
                                <div class="search_box">
                                        <h2>ARCHIEVE</h2>
                                        <div class="membership_container_right">
									<div class="membership_container_right_content_holder">
											<div class="pro_about" style="width:95%">
									
												<form name="form1" class="messagetype" id="form1" action="" method="post">
                                                                                                    <input type="hidden" name="data[messageType]" id="marking"  />
                                                        <input type="hidden" id="filter" name="data[type]"  />
												
												<?php echo $this->element('inbox_header'); ?>
									
									
												<div class="clearfix"></div>
							<div class="ckeckall">
                                                                <input type="checkbox" id="selecctall">
                                                                <p class="fills">Check all</p>
                                                        </div>
                                                        <div class="inbox_tab">
                                                                <div class="inner_tab">
                                                                        <!-- <input type="button" class="btn_log" name="" value="Compose" onclick="gotoCompose()"/>&nbsp; -->
                                                                        <!--<input type="button" class="btn_log off" name="" value="Inbox"/>&nbsp;-->
                                                                        <a class="tooltip" href="javascript:void(0);" onclick="set_mark('Read');"><img src="<?php echo($this->webroot);?>images/read_msg.png" title="Mark as Read"> <span>Mark as Read</span</a>
                                                                        <!--<a class="tooltip" href="javascript:void(0);" onclick="set_mark('Archive');" ><img src="<?php echo($this->webroot);?>images/arcive_msg.png" title="Move to Archive"> <span>Move to Archive</span></a>-->
                                                                        <a class="tooltip" href="javascript:void(0);" onclick="set_mark('Delete');"><img src="<?php echo($this->webroot);?>images/editing-delete-icon.png" title="Delete"> <span>Delete</span></a>
                                                                </div>
                                                        </div>                                        
									
			<style>
			.filter{float: right;
			    margin-right: 31px;
			    margin-top: 21px;
			    width: 45%;}
			.fills{float: left;}
			.fil{ margin-left: 10px;}
			</style>							<div class="clearfix"></div>
												<div class="listings">	
													<table cellpadding="0" cellspacing="0" class="data-table-bordered">
													<!--<tr>
														<th class="name"><input type="checkbox" id="selecctall"></th>
														<th class="name"><?php echo $this->Paginator->sort('sender_id','From'); ?></th>
														<th class="name"><?php echo $this->Paginator->sort('subject'); ?></th>
														<th class="name"><?php echo $this->Paginator->sort('message'); ?></th>
														<th class="name"><?php echo $this->Paginator->sort('date_time','Sent On'); ?></th>
														<th class="actions"><?php echo __('Actions'); ?></th>
													</tr>-->
													<tr>
														<td class="tab_head">
															<div class="chebox"></div>
															<div class="sender">Task</div>
															<div class="sender">Sender</div>
															<div class="last_message">Last Message</div>
															<div class="updated">Updated</div>
												
														</td>
													</tr>
													
									<?php 

									foreach ($inboxMessages as $inboxMessage): ?>
													<tr <?php echo($inboxMessage['InboxMessage']['read']==0?'style="background:#eee;"':'')?>>
														<td>
														<div class="msg_check"><input type="checkbox" class="checkbox1" name="data[msgid][]" value="<?php echo $inboxMessage['InboxMessage']['id'];?>"></div>
														<div class="msg_des">
															<p><a href="<?php echo ($this->webroot).'inbox_messages/conversations/'.base64_encode($inboxMessage['InboxMessage']['task_id']).'/'.base64_encode($inboxMessage['InboxMessage']['sender_id']).'/'.base64_encode($inboxMessage['InboxMessage']['id']); ?>" ><?php echo h($inboxMessage['Task']['title']); ?></a></p>
														</div>
														<div class="msg_des">
															<p><a href="<?php echo ($this->webroot).'inbox_messages/conversations/'.base64_encode($inboxMessage['InboxMessage']['task_id']).'/'.base64_encode($inboxMessage['InboxMessage']['sender_id']).'/'.base64_encode($inboxMessage['InboxMessage']['id']); ?>" ><?php echo h($this->requestAction('sent_messages/getUsername/'.$inboxMessage['InboxMessage']['sender_id'])); ?></a></p>
														</div>
														
														<div class="right_action">
															<a href="<?php echo ($this->webroot).'inbox_messages/conversations/'.base64_encode($inboxMessage['InboxMessage']['task_id']).'/'.base64_encode($inboxMessage['InboxMessage']['sender_id']).'/'.base64_encode($inboxMessage['InboxMessage']['id']); ?>" ><?php echo (strip_tags(substr($inboxMessage['InboxMessage']['subject'],0,100))); ?></a>
														</div>
											
														<?php
															$conut_msg=$this->requestAction('inbox_messages/count_message/'.base64_encode($inboxMessage['InboxMessage']['task_id']));
														?>
														<div class="bottom_text">
															<b><?php echo h(date('d M, Y',strtotime($inboxMessage['InboxMessage']['date_time']))); ?>	</b>								
														</div>
											
													</td>
											
												
												

			<?php // echo $this->Html->link(__('Delete'), array('controller' => 'inbox_messages','action' => 'delete', ($inboxMessage['InboxMessage']['id']))); ?>
											
													</tr>
												<?php endforeach; ?>
													</table>
													<p>
													<?php
										
													?>	</p>
													<div class="paging">
													<?php
														echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
														echo $this->Paginator->numbers(array('separator' => ''));
														echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
													?>
													</div>
												</div>
												</form>
											</div>
								
									</div>
								</div>
                                </div>
                                
                                
                        </div>
                    </div>
            </div>
    </div>
</section>



