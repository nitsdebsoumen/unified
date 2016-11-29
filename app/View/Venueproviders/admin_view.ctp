<?php //pr($user);?>
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
        <dt><?php echo __('Featured'); ?></dt>
        <dd>
            <?php echo h(($user['User']['featured']==1)?'Active':'Inactive'); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('KYC Status'); ?></dt>
        <dd>
            <?php 
            if(!empty($user['KycStatus']) && $user['KycStatus']['id']!=''){
            echo h(($user['KycStatus']['varification_status']==1)?'Active':'Inactive'); ?>
            &nbsp;
            <?php if($user['KycStatus']['varification_status']==1 || $user['KycStatus']['varification_status']==0){ ?>
            <a href="<?php echo($this->webroot); ?>admin/kycdocs/edit/<?php echo $user['KycStatus']['id']; ?>">(Details)</a>
            <?php } } else { echo "No KYC Details"; }  ?>
        </dd>
        <dt><?php echo __('Is Admin'); ?></dt>
        <dd>
			<?php echo h(($user['User']['is_admin']==1)?'Yes':'No'); ?>
            &nbsp;
        </dd>

    </dl>

   <a href="<?php echo($this->webroot); ?>admin/venues/add/<?php echo base64_encode($user['User']['id']); ?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Venues</a>
    <a href="<?php echo($this->webroot); ?>admin/kycdocs/add/<?php echo $user['User']['id'];?>" class="btn btn-info pull-left"><i class="fa fa-plus"></i> Add KYC</a>

<div class="faqs index">
    <h2><?php echo __('Venues'); ?></h2>
    <table style="width:100%;border:0px solid red;">

        <table cellpadding="0" cellspacing="0">

           <!--  <tr>
                <td style="width:10%;border:0px solid red;">&nbsp;</td>
            <a href="<?php echo($this->webroot); ?>admin/venues/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Venues</a>  
            </tr> -->
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('user_id'); ?></th>
                <!-- <th><?php echo $this->Paginator->sort('post_id'); ?></th> -->
                
                <th><?php echo $this->Paginator->sort('venue_name'); ?></th>
                <th><?php echo $this->Paginator->sort('description'); ?></th>
                <th><?php echo $this->Paginator->sort('size'); ?></th>
                <th><?php echo $this->Paginator->sort('price'); ?></th>
                <th><?php echo $this->Paginator->sort('featured'); ?></th>
                <th><?php echo $this->Paginator->sort('sort_of_details'); ?></th>
               <!--<th class="actions"><?php echo __('Actions'); ?></th>-->
            </tr>

            <?php
            if (!empty($venues)) :
                foreach ($venues as $key => $venues) :
                    ?>
                    <tr>
                        <td>
                            <?php
                            echo ++$key;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $venues['User']['first_name'] . ' ' . $venues['User']['last_name'];
                            ?>
                        </td>
                      <!--   <td>
                            <?php
                            echo $venues['Post']['post_title'];
                            ?>
                        </td> -->
                       
                        <td>
                            <?php
                            echo h(strip_tags($venues['Venue']['venue_name']));
                            ?>
                        </td>
                        <td>
                            <?php
                            echo h(strip_tags($venues['Venue']['description']));
                            ?>
                        </td>
                        <td>
                            <?php
                            echo h(strip_tags($venues['Venue']['size']));
                            ?>
                        </td>
                        <td>
                            <?php
                            echo h(strip_tags($venues['Venue']['price']));
                            ?>
                        </td>
                        <td><?php if($venues['Venue']['featured']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;
                        </td>
                        <td>
                            <?php
                            echo h(strip_tags($venues['Venue']['sort_of_details']));
                            ?>
                        </td>

                
                    </tr>
                    <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="6"><?php echo __('No Venue found'); ?></td>
                </tr>
            <?php
            endif;
            ?>
        </table>
        <p>
            <?php
            echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
            ));
            ?>  </p>
        <div class="paging">
            <?php
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
            ?>
        </div>
</div>


</div>
<?php //echo $this->element('admin_sidebar'); ?>
