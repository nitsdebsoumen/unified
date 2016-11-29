<?php //pr($user); ?>
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
        <!-- <dt><?php //echo __('Has Marketplace'); ?></dt>
        <dd>
			<?php //echo h(($user['User']['has_marketplace']==1)?'Active':'Inactive'); ?>
            &nbsp;
        </dd>
        <dt><?php //echo __('Social Login'); ?></dt>
        <dd>
			<?php //echo h(($user['User']['is_sociallogin']==1)?'Active':'Inactive'); ?>
            &nbsp;
        </dd> -->
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
        <dt><?php echo __('Featured'); ?></dt>
        <dd>
            <?php echo h(($user['User']['featured']==1)?'Yes':'No'); ?>
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
        <dt><?php echo __('No. of Orders'); ?></dt>
        <dd>
            <?php echo h(count($user_orders)); ?>
            &nbsp;
        </dd>
         <dt><?php echo __('Total Revenew'); ?></dt>
        <dd>
            <?php 
            $revenew = 0;
            foreach ($user_orders as $key => $value) {
                $revenew = $revenew + $value['Order']['amount'];
                
            } echo '₦ '.h($revenew);?>
            &nbsp;
        </dd>

    </dl>
    <a href="<?php echo($this->webroot);?>admin/posts/add/<?php echo base64_encode($user['User']['id'])?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Courses</a>
    <a href="<?php echo($this->webroot); ?>admin/kycdocs/add/<?php echo $user['User']['id'];?>" class="btn btn-info pull-left"><i class="fa fa-plus"></i> Add KYC</a>
<div class="categories index">
    <h2><?php echo __('Course Listing Of This User'); ?></h2>
    <div>
       
       
    </div>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('image'); ?></th>
            <th><?php echo $this->Paginator->sort('provider_name'); ?></th>
            <th><?php echo $this->Paginator->sort('post_title', 'Course Title'); ?></th>
            <th><?php echo $this->Paginator->sort('post_description', 'Course Description'); ?></th>
            <th><?php echo $this->Paginator->sort('is_approve'); ?></th>
            <th><?php echo $this->Paginator->sort('featured'); ?></th>
            <th><?php echo $this->Paginator->sort('is_show_home_page'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id','Posted By'); ?></th>
            <th><?php echo $this->Paginator->sort('category_id', 'Course Category'); ?></th>
     
        </tr>
    <?php 
        $CatCnt=0;
        foreach ($posts as $post): 
            $CatCnt++;
    //pr($category);
    ?>
        <tr>
            <td><?php echo $CatCnt;//echo h($category['Category']['id']); ?>&nbsp;</td>
            <td>
                    <?php if(!empty($post['PostImage']['0']['originalpath']))
                    { ?>
                <img src="<?php echo $this->webroot; ?>/img/post_img/<?php echo $post['PostImage']['0']['originalpath']; ?>" style="height:30px;" />
                        <?php
                    } ?>
            </td>
            <td>
                <?php echo $post['User']['first_name'].' '.$post['User']['last_name'];?>
            </td>
            <td><?php echo $post['Post']['post_title'];?></td>
            <td><?php echo $post['Post']['post_description'];?></td>
            <td><?php if($post['Post']['is_approve']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>
            <td><?php if($post['Post']['featured']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>
            <td><?php if($post['Post']['is_show_home_page']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>
            <td><a href="<?php echo $this->Html->url('/'); ?>admin/users/view/<?php echo $post['User']['id']; ?>"><?php echo h($post['User']['first_name']); ?>&nbsp;</a></td>
            <td><a href="<?php echo $this->Html->url('/'); ?>admin/categories/view/<?php echo $post['Category']['id']; ?>"><?php echo h($post['Category']['category_name']); ?>&nbsp;</a></td>
        <!--    <td class="actions">
            <?php //echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
            <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
            <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?',$post['Post']['id'])); ?>
            </td> -->



        </tr>
<?php endforeach; ?>
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
