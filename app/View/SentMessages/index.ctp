<?php ?>
<style type="text/css">
.listings{
	width:100%;
	border:0px solid red;
	padding:12px;
	text-align:left;
	margin:0px 0px 20px 0px;
}
/** Tables **/
table {
	border-right:0;
	clear: both;
	color: #333;
	margin: 10px 0px 10px 0px;
	width: 100%;
}
th {
	border:0;
	border-bottom:1px solid #dadbd6;
	text-align: left;
	padding:10px;
}
th a {
	display: block;
	padding: 2px 4px;
	text-decoration: none;
}
th a.asc:after {
	content: ' ⇣';
}
th a.desc:after {
	content: ' ⇡';
}
table tr td {
	padding: 10px;
	text-align: left;
	vertical-align: top;
	border-bottom:1px solid #ddd;
}
.headimg {
	background: #eeeeee;
}
table tr:nth-child(even) {
	background: #f9f9f9;
}
td.actions {
	text-align: left;
	white-space: nowrap;
}
table td.actions a {
	margin: 0px 6px;
	padding:5px 5px;
}
.data-table-bordered {
	border: 1px solid #dadbd6;
	border-collapse: separate;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}
/** Paging **/
.paging {
	background:#fff;
	color: #ccc;
	margin-top: 1em;
	clear:both;
}
.paging .current,
.paging .disabled,
.paging a {
	text-decoration: none;
	padding: 5px 8px;
	display: inline-block
}
.paging > span {
	display: inline-block;
	border: 1px solid #ccc;
	border-left: 0;
}
.paging > span:hover {
	background: #efefef;
}
.paging .prev {
	border-left: 1px solid #ccc;
	-moz-border-radius: 4px 0 0 4px;
	-webkit-border-radius: 4px 0 0 4px;
	border-radius: 4px 0 0 4px;
}
.paging .next {
	-moz-border-radius: 0 4px 4px 0;
	-webkit-border-radius: 0 4px 4px 0;
	border-radius: 0 4px 4px 0;
}
.paging .disabled {
	color: #ddd;
}
.paging .disabled:hover {
	background: transparent;
}
.paging .current {
	background: #efefef;
	color: #c73e14;
}
.name {
	color:#009cdb;
}
.name a {
	color:#009cdb;
}
.pro_about{height:auto;width:95%;padding:18px;background: white;border-radius:3px;box-shadow:0 0 2px #999;margin-top:20px;float:left;margin-left:20px;padding:20px;}
.profile_btn{border:1px solid #dadbda;padding:5px 10px 5px 10px;color:#747674;border-radius: 3px;margin:10px 0px 0px 0px;}
.pro_right_btn{float:right !important;margin-right:10px;border:0px !important;margin-top:13px;}

.btn_log{width: 78px;
height: 34px;
border-radius: 4px;
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
background: #f98e1b;
text-align: center;
font-size: 14px;
color: #fff;
float: left;}
.off{background: #F98E3F;font-weight:bold;}
/*@media only screen and (max-width: 568px) 
		{
		
		table, thead, tbody, th, td, tr { 
			display: block; 
		}
		
		
		table.data-table-bordered thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		table.data-table-bordered tr {border: 1px solid #ccc; }
		
		table.data-table-bordered td { 
			
			border: none;
			position: relative;
			padding-left: 50%; 
		}
		
		table.data-table-bordered td:before { 
			
			position: absolute;
			
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
	
	
		 	 	 	 	
		table.data-table-bordered td:nth-of-type(2):before { content: "From"; }
		table.data-table-bordered td:nth-of-type(3):before { content: "Subject"; }
		table.data-table-bordered td:nth-of-type(4):before { content: "Message"; }
		table.data-table-bordered td:nth-of-type(5):before { content: "Sent On"; }
		table.data-table-bordered td:nth-of-type(6):before { content: "Total"; }
		table.data-table-bordered td:nth-of-type(7):before { content: "Actions"; }
		table.data-table-bordered tr:first-child{display:none;} 
		.pro_about,.profile_holder,.listings{height:auto;width:100%;margin-left:0px;padding:0;}
		table td.actions a{padding:0 !important;}
	}*/


</style>
<script type="text/javascript">
function gotoSent()
{
	window.location.href="<?php echo($this->webroot);?>sent_messages/";
}
function gotoInbox()
{
	window.location.href="<?php echo($this->webroot);?>inbox_messages/";
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
                                        <h2>SENT BOX</h2>
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
										
													<tr>
														<td class="tab_head">
															<div class="chebox"></div>
															<div class="sender">To</div>
															<div class="last_message"> Message</div>
															<div class="updated">Updated</div>
												
														</td>
													</tr>
									<?php 

									foreach ($sentMessages as $sentMessage): ?>
													<tr >
														<td>
														<div class="msg_check">&nbsp; <input type="checkbox" class="checkbox1" name="data[msgid][]" value="<?php echo $sentMessage['SentMessage']['id'];?>"></div>
														<div class="msg_des">
											
														<p><?php echo h($this->requestAction('sent_messages/getUsername/'.$sentMessage['SentMessage']['receiver_id'])); ?></p>
											
											
											
												
														</div>
														<div class="right_action">
                <?php
                if($sentMessage['SentMessage']['task_id']!=0){
                    $linkUser=$this->webroot.'inbox_messages/conversations/'.base64_encode($sentMessage['SentMessage']['task_id']).'/'.base64_encode($sentMessage['SentMessage']['receiver_id']).'/'.base64_encode($sentMessage['SentMessage']['id']);
                }else{
                    //$linkUser=$this->webroot.'inbox_messages/user_conversations/'.base64_encode($sentMessage['SentMessage']['task_id']).'/'.base64_encode($sentMessage['SentMessage']['receiver_id']).'/'.base64_encode($sentMessage['SentMessage']['id']);
                    $linkUser=$this->webroot.'inbox_messages/conversations/'.base64_encode($sentMessage['SentMessage']['task_id']).'/'.base64_encode($sentMessage['SentMessage']['receiver_id']).'/'.base64_encode($sentMessage['SentMessage']['id']);
                }
                ?>
											
															<a href="<?php echo $linkUser; ?>" ><?php echo (strip_tags(substr($sentMessage['SentMessage']['message'],0,100))); ?></a>
	
														</div>
											
														<?php
															//$conut_msg=$this->requestAction('inbox_messages/count_message/'.base64_encode($sentMessage['SentMessage']['task_id']));
														?>
														<div class="bottom_text" style="text-align:center">
															<b><?php echo h(date('d M, Y',strtotime($sentMessage['SentMessage']['date_time']))); ?>	</b>								
														</div>
											
													</td>
											
												
												

			<?php  ?>
											
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

<style>
#content {
width: 100% !important;
border: 0px;
float:left;
height:auto;
}
</style>


