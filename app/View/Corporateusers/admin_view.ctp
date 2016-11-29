<div class="users view">
    <h2><?php echo __('User'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
			<?php echo h($user['User']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('First Name'); ?></dt>
        <dd>
			<?php echo h($user['User']['first_name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Last Name'); ?></dt>
        <dd>
			<?php echo h($user['User']['last_name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Profile Image'); ?></dt>
        <dd>
			<?php
                        $uploadImgPath = WWW_ROOT.'user_images';
                         $per_profile_img=isset($user['UserImage']['0']['originalpath'])?$user['UserImage']['0']['originalpath']:'';
                        if($per_profile_img!='' && file_exists($uploadImgPath . '/' . $per_profile_img)){
                            $ImgLink=$this->webroot.'user_images/'.$per_profile_img;
                        }else{
                            $ImgLink=$this->webroot.'user_images/default.png';
                        } 
                        echo '<img src="'.$ImgLink.'" alt="" height="100px" width="100px"/>';
                        ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Country'); ?></dt>
        <dd>
			<?php echo h($user['Country']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('City'); ?></dt>
        <dd>
			<?php echo h($user['User']['city']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('state'); ?></dt>
        <dd>
			<?php echo h($user['User']['state']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Zip'); ?></dt>
        <dd>
			<?php echo h($user['User']['zip']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Email'); ?></dt>
        <dd>
			<?php echo h($user['User']['email_address']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Member Since'); ?></dt>
        <dd>
			<?php echo h($user['User']['member_since']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Has Marketplace'); ?></dt>
        <dd>
			<?php echo h(($user['User']['has_marketplace']==1)?'Active':'Inactive'); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Social Login'); ?></dt>
        <dd>
			<?php echo h(($user['User']['is_sociallogin']==1)?'Active':'Inactive'); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Activity Status'); ?></dt>
        <dd>
			<?php echo h(($user['User']['status']==1)?'Active':'Inactive'); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Is Admin'); ?></dt>
        <dd>
			<?php echo h(($user['User']['is_admin']==1)?'Yes':'No'); ?>
            &nbsp;
        </dd>

    </dl>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
