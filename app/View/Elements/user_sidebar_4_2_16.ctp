<?php ?>
<div class="left_panel_dashbpard">
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
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
            </span>Dashboard</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
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
                           <a href="">Payments History</a>
                        </td>
                    </tr>
                                                    <tr>
                        <td>
                            <a href="">Payment Methods</a>
                        </td>
                    </tr>
                                                    <tr>
                        <td>
                            <a href="">Reviews</a>
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
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-th">
            </span>Settings</a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
            <table class="table">
            <tr>
                <td>
                    <a href="<?php echo $this->webroot;?>users/editprofile">Profile</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="">Skills</a>
                </td>
            </tr>
            <!--<tr>
                <td>
                    <a href="">Verifications</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="">Alerts</a>
                </td>
            </tr>-->
            <tr>
                <td>
                    <a href="">Mobile</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="">Portfolio</a>
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
    </div>
</div>
</div>
