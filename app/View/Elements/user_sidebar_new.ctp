<?php 
$ActiveController=$this->params['controller'];
$ActiveAction=$this->params['action'];
if($ActiveController=='users' && ($ActiveAction=='editprofile' || $ActiveAction=='skill' || $ActiveAction=='billing' || $ActiveAction=='change_password' || $ActiveAction=='portfolio')){
        $ActNavClass='in';
}
$user_type=isset($userdetails['User']['user_type'])?$userdetails['User']['user_type']:'';
?>
<div class="left_panel_dashbpard">
    <div class="col-md-12 whit_bg" style>
    <div class="col-md-4">
    <div class="profile_image" style="margin-top:20px; min-height: 315px;">
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
   </div>
    
   <!-- <div class="rating">
<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
</div>-->
<div class="col-md-4">
<div class="panel-group" id="accordion">
    
     <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-th">
            </span>Dashboard</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse <?php echo (!isset($ActNavClass))?'in':'';?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo $this->webroot; ?>inbox_messages">Messages <?php echo((isset($inbxMsgCnt) && $inbxMsgCnt!=0)?'<span class="notify">'.$inbxMsgCnt.'</span>':'');?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?php echo $this->webroot; ?>users/my_task">Tasks Posted</a>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <a href="<?php echo $this->webroot; ?>users/my_assign_task">Task Running</a>
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
                            <a href="<?php echo $this->webroot; ?>notifications/">Notifications <?php echo((isset($notiCnt) && $notiCnt!=0)?'<span class="notify">'.$notiCnt.'</span>':'');?></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<div class="col-md-4">
<div class="panel-group" id="accordion">
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-th">
            </span>Settings</a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse in <?php //echo isset($ActNavClass)?$ActNavClass:'';?>">
            <div class="panel-body">
            <table class="table">
            <tr>
                <td style="padding: 15px 0;">
                    <a href="<?php echo $this->webroot;?>users/editprofile">Profile</a>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 0;">
                    <a href="<?php echo $this->webroot;?>users/skill">Skills</a>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 0;">
                    <a href="<?php echo $this->webroot;?>users/verification">Verifications</a>
                </td>
            </tr>
            <!--<tr>
                <td>
                    <a href="">Alerts</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="<?php echo $this->webroot;?>users/mobile_no">Mobile</a>
                </td>
            </tr>-->
            <tr>
                <td style="padding: 15px 0;">
                    <a href="<?php echo $this->webroot; ?>users/billing">Billing</a>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 0;">
                    <a href="<?php echo $this->webroot; ?>users/portfolio">Portfolio</a>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 0;">
                    <a href="<?php echo $this->webroot;?>users/change_password">Password</a>
                </td>
            </tr>
            </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<div class="col-md-12" style="padding:15px 0;">
 <div class="panel-heading" style="background-image: linear-gradient(to bottom, #f5f5f5 0%, #e8e8e8 100%);
background-repeat: repeat-x;margin-top: 15px;">
    <h4>My Rating</h4>
</div>
    <div style="text-align:center;" id="rateStar_1"></div>
<?php 
$tot_rating=$userdetails['User']['tot_rating'];
echo '<script>
$(document).ready(function(){
$("#rateStar_1").raty({score:'.$tot_rating.',readOnly:true, halfShow : true});
});</script>';
?>
</div>
</div>

<style type="text/css">
.rating > span:hover:before {
   content: "\2605";
   position: absolute;
}

#rateStar_1 {padding: 10px 10px;}

.fa-fw {
width: 5em;
text-align: center;
font-size: 25px;
}

/*.task_summery h2 {display: inline-block;}*/

h1.new-style{background-image: linear-gradient(to bottom, #f5f5f5 0%, #e8e8e8 100%);
background-repeat: repeat-x;
margin-top: 15px;

padding: 18px 15px;
border-bottom: 1px solid transparent;
border-top-right-radius: 3px;
border-top-left-radius: 3px;
color: #000
}
.whit_bg {background: rgba(255, 255, 255, 0); }
.right_dash_board {height: auto;/*background: rgba(255, 255, 255, 0);*/ }
h2.new_h2 {display:inline-block;font-size:12px;}
</style>
