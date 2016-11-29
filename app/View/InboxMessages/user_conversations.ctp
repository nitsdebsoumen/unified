<?php ?>

<form name="form1" class="messagetype" id="form1" action="" method="post">
	<input type="hidden" name="data[messageType]" id="marking"  />
	<input type="hidden" id="filter" name="data[type]"  />
</form>
<?php echo $this->element('user_menu'); ?>
<section class="main_body">
    <div class="container">
            <div class="row">
                    <div class="col-md-3">
                            <?php echo $this->element('user_sidebar'); ?>
                    </div>
                    <div class="col-md-9 whit_bg">
                        <div class="">
                                <div class="search_box">
                                        <h2>Convertation With <?php echo ($this->requestAction('sent_messages/getUsername/'.$sender_id)); ?></h2>
                                        <div class="membership_container_right">
									<div class="membership_container_right_content_holder">
											<div class="pro_about">
								
												<div class="clearfix"></div>
												 <?php echo $this->element('inbox_header'); ?>
												
									
												<div class="clearfix"></div>
						
											<table class="conversation">
												<tr>
													<!--<td>
													<div class="inbox_tab">
														<div class="inner_tab">
															<a class="tooltip" href="javascript:void(0);" onclick="set_mark('Spam');"><img title="Label" src="<?php echo ($this->webroot); ?>images/tag.png"> <span>Mark as Label</span></a>
															<a class="tooltip" href="javascript:void(0);" onclick="set_mark('Flag');"><img title="Flag" src="<?php echo ($this->webroot); ?>images/flag_msg.png"> <span>Mark as Flag</span></a>
															<a class="tooltip" href="javascript:void(0);" onclick="set_mark('Archive');"><img title="Archive" src="<?php echo ($this->webroot); ?>images/arcive_msg.png"> <span>Mark as Archive</span></a>
															<a class="tooltip" href="javascript:void(0);" onclick="set_mark('Delete');"><img title="Delete" src="<?php echo ($this->webroot); ?>images/editing-delete-icon.png"> <span>Delete</span></a>
														</div>
													</div>
										
													</td>-->
												</tr>
												<?php 
												foreach ($inboxMessages as $inboxMessage): ?>
												<tr <?php 
													if($userid==$inboxMessage['InboxMessage']['sender_id']) { 
													echo($inboxMessage['InboxMessage']['read']==0?'style="background:#f9f9f9;"':''); 
													} 
													?>>
													<td>
													<?php 
														$senderUser = $this->requestAction('sent_messages/getUserDetails/'.$inboxMessage['InboxMessage']['sender_id']);
														$uploadFolder = "user_images";
														$uploadPath = WWW_ROOT . $uploadFolder;
														$imageName = $senderUser['User']['profile_img'];
														if(file_exists($uploadPath . '/' . $imageName) && $imageName!=''){
															 $senderImage = 'user_images/'.$imageName;
															// echo($this->Html->image('/user_images/'.$imageName, array('alt' => $user['User']['user_name'],'style'=>'width:250px;height:250px')));
														} else {
															$senderImage = 'user_images/default.png';
															//echo($this->Html->image('/user_images/default.png', array('alt' => $user['User']['user_name'],'style'=>'width:250px;height:250px')));
														}
													?>
														<div class="left_image_conv"> 
															<img title="<?php echo $senderUser['User']['first_name'].' '.$senderUser['User']['last_name'];?>" src="<?php echo ($this->webroot).$senderImage; ?>">
														</div>
														<div class="right_conv">
														<?php
														//echo $userid."-".$inboxMessage['InboxMessage']['sender_id'];
														if($userid==$inboxMessage['InboxMessage']['sender_id']) { ?>
														<b>Me</b>

														<?php } else { ?>

															<b><?php echo $sendname = ($this->requestAction('sent_messages/getUsername/'.$inboxMessage['InboxMessage']['sender_id'])); ?></b>

														<?php } ?>
														<span><?php echo ($inboxMessage['InboxMessage']['subject']); ?></span>
														<?php echo $inboxMessage['InboxMessage']['message']; ?>
														</div>
											
														<?php if($userid!=$inboxMessage['InboxMessage']['sender_id'] && $inboxMessage['InboxMessage']['sender_id']!='1' ) {?>
														<div>
															<a href="javascript:void()" onclick="showMessage('<?php echo $inboxMessage['InboxMessage']['sender_id'];?>','<?php echo $sendname;?>');">Reply</a>
														</div>
														<?php }?>
											
														<?php
                                                                                                                $uploadInboxPath = WWW_ROOT .'location' ;
                                                                                                                if(file_exists($uploadInboxPath . '/' . $inboxMessage['InboxMessage']['location']) && $inboxMessage['InboxMessage']['location']!=''){ ?>
												
														<div class="attach_ment">
															<a href="<?php echo($this->webroot).'location/'.($inboxMessage['InboxMessage']['location']);?>" target="_blank"><img title="Download attachment" src="<?php echo ($this->webroot); ?>images/attach.png"></a>
														</div>
														 <?php } ?>
											
														<div class="clearfix"></div>
														<div class="bottom_conv">
															<?php echo (date('M d, Y H:i',strtotime($inboxMessage['InboxMessage']['date_time']))); ?>
														</div>
													</td>
												</tr>
									
												<?php endforeach; ?>
											</table>
											<form name="sendmesg" id="sendmesg" action="<?php echo $this->webroot; ?>inbox_messages/user_reply/<?php echo(base64_encode($msg_id));?>" method="post" enctype="multipart/form-data" >
											<input type="hidden" name="data[SentMessage][receiver_id]" id="SentMessageReceiverId" value="">
											<input type="hidden" name="data[SentMessage][subject]" maxlength="100" id="SentMessageSubject" readonly class="contact_text_box" placeholder="Subject" value="Re: <?php echo($lastText['InboxMessage']['subject']);?>"/>
											<div class="reply_covertation" id="MsgDiv" style="display:none">
												<div class="inner_covertation">
                                                                                                    <span style="text-transform: none;">Send a message to  <b id="sendName"></b></span>
													<textarea name="data[SentMessage][message]" id="SentMessageMessage" ></textarea>
													<div class="send_sec">
														<input type="button" class="atch_btn" value="Attach Files" onclick="$('#theFile' ).click();"/>
														<input type="file" name="data[SentMessage][location]" id="theFile" class="contact_text_box" value="" style="display:none;"/>
														<input type="submit" class="send_btn" value="Send"/>
													</div>
												</div>
											</div>
											</form>
											</div>
											<br/><br/><br/><br/>
								
									</div>
								</div>
                                </div>
                                
                                
                        </div>
                    </div>
            </div>
    </div>
</section>



