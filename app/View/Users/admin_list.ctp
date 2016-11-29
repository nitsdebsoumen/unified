<?php?>
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--statistics start-->
            <div class="row state-overview">
                <div class="col-md-1 col-xs-6 col-sm-1">&nbsp;</div>
                <div class="col-md-3 col-xs-12 col-sm-3">
                    <div class="panel purple">
                        <div class="symbol">
                            <i class="fa fa-gavel"></i>
                        </div>
                        <div class="state-value">
                            <div class="value"><?php echo $active_user;?></div>
                            <div class="title"><a href="Javascript: void(0);" class="UserStatus" id="1">Active Users</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-3">
                    <div class="panel red">
                        <div class="symbol">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="state-value">
                            <div class="value"><?php echo $inactive_user;?></div>
                            <div class="title"><a href="Javascript: void(0);" class="UserStatus" id="0">Inactive Users</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-3">
                    <div class="panel blue">
                        <div class="symbol">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="state-value">
                            <div class="value"><?php echo $this->Paginator->counter(array('format' => __('{:count}')));?></div>
                            <div class="title">Total Users</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--statistics end-->
        </div>
    </div>
</div>
<?php echo isset($my_variable) ? $my_variable : ''; ?>
<div class="users index">
	<h2 style="width:400px;float:left;"><?php echo __('Users'); ?></h2>
        <div>
       <?php //echo $this->Form->create("User");?>
            <form name="Searchuserfrm" method="post" action="" id="Searchuserfrm">   
        <table style=" border:none;">
            <tr>
                <td>Phone number</td>
                <td><input type="text" name="phonenumber" value="<?php echo isset($phonenumber)?$phonenumber:'';?>" placeholder="Search by phone number."></td>
		        <td>Email</td>
                <td><input type="email" name="email" value="<?php echo isset($email)?$email:'';?>" placeholder="Search by email address."></td>
                <td>Name/ Last name</td>
                <td><input type="text" name="name" value="<?php echo isset($name)?$name:'';?>" placeholder="Search by name."></td>
		      <td><input type="submit" name="search" value="Search"></td>
            </tr>      
        </table>
            </form>
        <?php //echo $this->Form->end();?>
        </div>
        
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th>SN<?php //echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('first_name'); ?></th>
		<th><?php echo $this->Paginator->sort('last_name'); ?></th>
		<th>Profile</th>
		<th>Country</th>
		<th><?php echo $this->Paginator->sort('zip','Zip Code – Location'); ?></th>
		<th><?php echo $this->Paginator->sort('member_since','Member Since'); ?></th>
		<th><?php echo $this->Paginator->sort('email_address','Email'); ?></th>
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
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete %s?', $user['User']['first_name'])); ?>
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
<?php //echo $this->element('admin_sidebar'); ?>


<script type="text/javascript">
    $(document).ready(function(){       
        $('.UserStatus').click(function(){ 
            var UserStatus=$(this).attr('id');
            $('#search_is_active').val(UserStatus);
            $('#Searchuserfrm').submit();
            //document.Searchuserfrm.submit();
            //$('#UserAdminListForm')[0].submit();
        });
    });
</script>
<style>
.title a{
    color: #fff !important;
}
</style> 