<?php 
$ActiveController=$this->params['controller'];
$ActiveAction=$this->params['action'];
if($ActiveController=='users' && ($ActiveAction=='editprofile' || $ActiveAction=='skill' || $ActiveAction=='billing' || $ActiveAction=='change_password' || $ActiveAction=='portfolio' || $ActiveAction=='verification')){
        $ActNavClass='in';
}
$user_type=isset($userdetails['User']['user_type'])?$userdetails['User']['user_type']:'';
?>
<div class="left_panel_dashbpard" style="padding:0;">
    <div class="profile_image">
    <?php
        $UserProfile_img=isset($userdetails['User']['profile_img'])?$userdetails['User']['profile_img']:'';
        $uploadImgPath = WWW_ROOT.'user_images';
        if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
            echo '<img src="'.$this->webroot.'user_images/'.$UserProfile_img.'" alt="" />';
        }else{
            echo '<img src="'.$this->webroot.'user_images/default.png" alt="" />';
        }
    ?>
    </div>
<h2><?php 
    $UserFName=isset($userdetails['User']['first_name'])?$userdetails['User']['first_name']:'';
    $UserLName=isset($userdetails['User']['last_name'])?$userdetails['User']['last_name']:'';
    $UserFullName=$UserFName.' '.$UserLName;
    echo $UserFullName;
    ?></h2>
    <!-- <div class="panel-heading" style="background-image: linear-gradient(to bottom, #f5f5f5 0%, #e8e8e8 100%);
background-repeat: repeat-x;margin-top: 15px;">
    <h4>My Rating</h4>
</div> -->
    <div style="margin-top:10px; text-align:center;" id="rateStar_1"></div>
<?php 
$tot_rating=$userdetails['User']['tot_rating'];
echo '<script>
$(document).ready(function(){
$("#rateStar_1").raty({score:'.$tot_rating.',readOnly:true, halfShow : true});
});
</script>';
?>
    
   <!-- <div class="rating">
<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
</div>-->

<!-- <div class="panel-group" id="accordion"> -->
   <!--  <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i style="margin-right:5px;font-size:16px;" class="fa fa-plus-circle"></i>Menu</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse <?php echo (!isset($ActNavClass))?'in':'';?>">
            <div class="panel-body">
                <table class="table">
                    <tr>

                        <td>
                            <a href="<?php echo $this->webroot; ?>users/dashboard">Dashboard</a>
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <a href="<?php echo $this->webroot; ?>inbox_messages">Messages <?php echo((isset($inbxMsgCnt) && $inbxMsgCnt!=0)?'<span class="notify">'.$inbxMsgCnt.'</span>':'');?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?php echo $this->webroot; ?>users/my_task">Errands Posted</a>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <a href="<?php echo $this->webroot; ?>users/my_assign_task">Errand Running</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <?php
                            
                            $PaymentNot=$notiRFundCnt;
                            ?>
                           <a href="<?php echo $this->webroot.'users/payment_history';; ?>">Payments History <?php echo((isset($PaymentNot) && $PaymentNot!=0)?'<span class="notify">'.$PaymentNot.'</span>':'');?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?php echo $this->webroot; ?>users/billing_address">Billing Address</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?php echo $this->webroot; ?>users/review">Reviews</a>
                        </td>
                    </tr>
                                                    <tr>
                        <td>
                            <a href="<?php echo $this->webroot; ?>notifications/">Alerts <?php echo((isset($notiCnt) && $notiCnt!=0)?'<span class="notify">'.$notiCnt.'</span>':'');?></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div> -->
    <!-- <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><i style="margin-right:5px;font-size:16px;" class="fa fa-plus-circle"></i>
            </span>Settings</a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse <?php echo isset($ActNavClass)?$ActNavClass:'';?>">
            <div class="panel-body">
            <table class="table">
            <tr>
                <td>
                    <a href="<?php echo $this->webroot;?>users/editprofile">Profile</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="<?php echo $this->webroot;?>users/skill">Skills</a>
                </td>
            </tr>
           <tr>
                <td>
                    <a href="<?php echo $this->webroot;?>users/verification">Verifications</a>
                </td>
            </tr>
             
            <tr>
                <td>
                    <a href="<?php echo $this->webroot; ?>users/billing">Billing</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="<?php echo $this->webroot; ?>users/portfolio">Portfolio</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="<?php echo $this->webroot;?>users/change_password">Password</a>
                </td>
            </tr>
            </table>
            </div>
        </div>
    </div> -->
<!-- </div> -->



    <div class="col-md-12" style="background:#fff; border:1px solid #ccc; padding:0; margin:10px 0;">
    <div class="left_panel_dashbpard" style="padding:0px;">
       
                <h4 style="font-size:17px;background:#ddd;
background-repeat: repeat-x;padding: 10px 0; margin:0px;text-align: center; font-weight:bold;"> What are you looking for? </h4>
            <div style="padding:15px 0;">
            <p style="font-size: 12px;text-align: center; padding:10px 0;">Post Errands and receive bids from qualified Errand Champs.</p>
            <p><img src="<?php echo $this->webroot;?>images/errandddddddd.png" class="img-responsive" style="margin:0 auto;"></p>

            <p style="text-align:center;"><a href="Javascript: void(0);" data-toggle="modal" class="btn btn-success btn-md post_an_errand">Post new Errand</a></p>
        </div>
    </div>
</div>


<div class="col-md-12" style="padding:0; margin-bottom:15px;">


    <h4 style="font-size:17px;background:#ddd;
background-repeat: repeat-x;padding: 10px 0; margin:0px;text-align: center; font-weight:bold;">Recent Activity on <?php echo $sitesetting['SiteSetting']['site_name'];?></h4>
                                            <div class="recent_activity" style="background:#fff;">
                                                    
                                                    <?php
                                                    //$this->loadModel('Notification');
                                                    //$options = array('conditions' => array('Notification.id !='=>0),'order'=>array('Notification.id Desc'),'limit'=>10);
            //$notifications = $this->Notification->find('all',$options);
                                                    if(isset($notifications) && !empty($notifications))
                                                    {
                                                        foreach($notifications as $val)
                                                        {
                                                           $sitelink = Configure::read('SITE_URL');
                                                           $UserProfile_img=isset($val['ByUser']['profile_img'])?$val['ByUser']['profile_img']:'';
                                               $uploadImgPath = WWW_ROOT.'user_images';
                                               if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                                                  $imgLink = $sitelink.'user_images/'.$UserProfile_img;
                                               }else{
                                                  $imgLink = $sitelink.'user_images/default.png';
                                               }
                                                        ?>
                                            <div class="media"> 
                                                <div class="media-left"> 
                                                       <a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($val['ByUser']['id']);?>/"> <img class="media-object" style="width: 25px; height: 25px;" src="<?php echo $imgLink;?>" data-holder-rendered="true"> </a> </div> 
                                                <div class="media-body"> 
                                                       <a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($val['ByUser']['id']);?>/"><?php echo $val['ByUser']['first_name'].' '.$val['ByUser']['last_name'];?></a> <?php echo $val['Notification']['type'];?> <a class="task-title" href="<?php echo $this->webroot?>errands/detail/<?php echo base64_encode($val['Task']['id']);?>/<?php echo $val['Task']['seo_url'];?>" ><?php echo $val['Task']['title'];?></a>
                                                </div> 
                                            </div>
                                            <?php
                                                        }
                                                    }else{
                                                        echo 'No Recent Activity';
                                                    }
                                                    ?>
                                                    
                                            </div>
                                    </div>




</div>

<style type="text/css">
.rating > span:hover:before {
   content: "\2605";
   position: absolute;
}

.fa-star, .fa-fw {font-size: 20px;}
</style>
