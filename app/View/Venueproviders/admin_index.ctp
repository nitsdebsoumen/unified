<?php
//pr($users);  
?>
<div class="users index">
	<h2 style="width:100%;float:left;"><?php echo __('Venue Providers'); ?></h2>
        
        
	<table cellpadding="0" cellspacing="0">
 <tr>
            <td style="width:70%;border:0px solid red;">&nbsp;</td>
<a href="<?php echo($this->webroot);?>admin/venueproviders/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Event Provider</a>  
        </tr>

	<tr>
		<th>SN<?php //echo $this->Paginator->sort('id'); ?></th>
		<th>Company Name</th>
		<th><?php echo $this->Paginator->sort('first_name'); ?></th>
		<th><?php echo $this->Paginator->sort('last_name'); ?></th>
		<th>Profile</th>
		<th>Country</th>
		<th><?php echo $this->Paginator->sort('zip','Zip Code – Location'); ?></th>
		<th><?php echo $this->Paginator->sort('member_since','Member Since'); ?></th>
		<th><?php echo $this->Paginator->sort('email_address','Email'); ?></th>
		<th><?php echo $this->Paginator->sort('featured','Featured'); ?></th>
		<th><?php echo $this->Paginator->sort('kyc_status'); ?></th>
		<th><?php echo $this->Paginator->sort('status','Activation Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
        $UserCnt=0;
        $uploadImgPath = WWW_ROOT.'user_images';
        foreach ($users as $user): 
	    //pr($user);
            $UserCnt++;?>
	<tr>
		<td><?php echo $UserCnt;//echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['Company']['company_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>		
		<td><?php
                        $per_profile_img=isset($user['UserImage']['0']['originalpath'])?$user['UserImage']['0']['originalpath']:'';
                        if($per_profile_img!='' && file_exists($uploadImgPath . '/' . $per_profile_img)){
                            $ImgLink=$this->webroot.'user_images/'.$per_profile_img;
                        }else{
                            $ImgLink=$this->webroot.'user_images/default.png';
                        } 
                        echo '<img src="'.$ImgLink.'" alt="" height="100px" width="100px"/>';
                        ?></td>
		<td><?php echo h($user['Country']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['zip']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['member_since']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email_address']); ?>&nbsp;</td>

		<td><?php if($user['User']['featured']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>

		<td><?php if($user['KycStatus']['varification_status']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>

		<td><?php if($user['User']['status']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;</td>
		
		<td >
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')),
                        array('action' => 'view', $user['User']['id']),
                        array('class' => 'btn btn-success btn-xs', 'escape'=>false)); ?>
                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $user['User']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
                            <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $user['User']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
                    </td>


	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>

<style>
.title a{
    color: #fff !important;
}
</style> 