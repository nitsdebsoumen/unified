<?php ?>        
<?php echo $this->element('user_menu'); ?>                                                
<section class="main_body">
    <div class="container">
            <div class="row">
                    <div class="col-md-3">
                            <?php echo $this->element('user_sidebar'); ?>
                    </div>
                    <div class="col-md-9">
                     <div class="whit_bg">
                        <div class="right_dash_board">
                                <div class="search_box">
                                        <h2>Alerts</h2>
                                </div>
                                
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="List">
                                        <div class="task_lists">
                                        Keep up to date with your errands here
                                                <ul class="media-list">
                                                <?php 
                                                if(count($my_notifications)>0){
                                                   foreach($my_notifications as $val){
                                            	   $sitelink = Configure::read('SITE_URL');
                                            	   $UserProfile_img=isset($val['ByUser']['profile_img'])?$val['ByUser']['profile_img']:'';
						   $uploadImgPath = WWW_ROOT.'user_images';
						   if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
							  $imgLink = $sitelink.'user_images/'.$UserProfile_img;
						   }else{
							  $imgLink = $sitelink.'user_images/default.png';
						   }
                                                ?>
                                                <li class="activity-feed">
                                                	<div class="text" >
		                                           	<span class="user-name-holder">
		                                           	<a class="user" href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($val['ByUser']['id']);?>/" style="background-image:url(<?php echo $imgLink;?>);padding-left:18px;" ><?php echo $val['ByUser']['first_name'].' '.$val['ByUser']['last_name'];?></a>
		                                           	</span>
		                                           	<span > <?php echo $val['Notification']['type'];?> </span>
		                                           	<a class="task-title" href="<?php echo $this->webroot?>errands/detail/<?php echo base64_encode($val['Task']['id']);?>/<?php echo $val['Task']['seo_url'];?>" ><?php echo $val['Task']['title'];?></a>
                                                	</div>
                                                	<div class="time">
                                                		<span datetime="13 days ago" style="visibility: visible;" ><?php echo $this->requestAction(array('controller'=>'notifications','action'=>'how_long_ago/'.strtotime($val['Notification']['date'])))?> ago</span>
                                                	</div>
                                                </li>
                                                
                                                   
                                                    
                                                <?php 
                                                    }
                                                }else{
                                                    echo '<li class="media"><p>No Alert found.</p></li> ';
                                                }
                                                ?>
                                                </ul>
                                        
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
    </div>
</section>


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


