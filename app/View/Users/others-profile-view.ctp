<?php
//echo base64_encode(93);
?>
<section class="listing_result">
	<div class="headerHero"></div>
    <div class="container">
        <div class="row training-list-area">
            <div class="col-md-3">
                <div class="training-list">
                    <?php
                        $uploadImgPath = WWW_ROOT.'user_images';    
                        $per_profile_img=isset($user['UserImage']['0']['originalpath'])?$user['UserImage']['0']['originalpath']:'';
                        if($per_profile_img!='' && file_exists($uploadImgPath . '/' . $per_profile_img)){
                            $ImgLink=$this->webroot.'user_images/'.$per_profile_img;
                        }else{
                            $ImgLink=$this->webroot.'user_images/default.png';
                        } 
                        echo '<img src="'.$ImgLink.'" alt="" height="150px" width="100px"/>';
                             ?>
                    <h4><?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name']; ?></h4>
                    <div class="star-area clearfix">
                        <div class="star pull-left">
                            <i aria-hidden="true" class="fa fa-star"></i>
                            <i aria-hidden="true" class="fa fa-star"></i>
                            <i aria-hidden="true" class="fa fa-star"></i>
                            <i aria-hidden="true" class="fa fa-star"></i>
                            <i aria-hidden="true" class="fa fa-star"></i>
                        </div>
                        <p class="pull-left" style="padding:0 0 0 5%; font-size:12px; color:#535353;">(12 reviews)</p>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-9">
                <div class="detail-mid-area">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Profile Details</h3>
                        </div>
                        
                        <div class="col-md-6">
                            <h4 style="padding:12px 0 10px;"><span class="training-cost">Name</span></h4>
                            <p><span class="training-price"><?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name']; ?></span></p>
                        </div>
                        
                        <div class="col-md-6">
                            <h4 style="padding:12px 0 10px;"><span class="training-cost">Email</span></h4>
                            <p><span class="training-price"><?php echo $user['User']['email_address']; ?></span></p>
                        </div>
                        
                        <div class="col-md-6">
                            <h4 style="padding:12px 0 10px;">Location</h4>
                            <p> <span class="training-price"> <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $user['User']['address'] . ', ' . $user['City']['name'] . ', ' . $user['State']['name'] . ', ' . $user['Country']['name'] . ', ' . $user['User']['zip']; ?></span> </p>
                        </div>
                        
                        <div class="col-md-6">
                            <h4 style="padding:12px 0 10px;"><span class="training-cost">Organization Name</span></h4>
                            <p><span class="training-price"><?php echo $user['User']['org_name']; ?></span></p>
                        </div>
                        
                        <div class="col-md-6">
                            <h4 style="padding:12px 0 10px;"><span class="training-cost">Job title</span></h4>
                            <p><span class="training-price"><?php echo $user['User']['job_title']; ?></span></p>
                        </div>
                        
                        <div class="col-md-6">
                            <h4 style="padding:12px 0 10px;"><span class="training-cost">Accounts Contact</span></h4>
                            <p><span class="training-price"><?php echo $user['User']['acc_contact']; ?></span></p>
                        </div>
                        
                        <div class="col-md-6">
                            <h4 style="padding:12px 0 10px;"><span class="training-cost">Accounts Email</span></h4>
                            <p><span class="training-price"><?php echo $user['User']['acc_email']; ?></span></p>
                        </div>
                        
                        <div class="col-md-6">
                            <h4 style="padding:12px 0 10px;"><span class="training-cost">Accounts Telephone</span></h4>
                            <p><span class="training-price"><?php echo $user['User']['acc_tel']; ?></span></p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>