<?php?>
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--statistics start-->
            <div class="row state-overview">
                <div class="col-md-1 col-xs-6 col-sm-1">&nbsp;</div>
                
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
<div class="users index">
	<h2 style="width:400px;float:left;"><?php echo __('Users'); ?></h2>
	<a href="<?php echo $this->webroot.'admin/users/export'; ?>" style="float:right">Export Users</a>
        <div>
       <?php //echo $this->Form->create("User");?>
            <form name="Searchuserfrm" method="post" action="" id="Searchuserfrm">   
        <table style=" border:none;">
            <tr>
                <td>Keyword</td>
                <td><input type="text" name="keyword" value="<?php echo isset($Keywords)?$Keywords:'';?>" placeholder="Search by Keyword."></td>
                <td>Activity Status</td>
                <td><select name="search_is_active" id="search_is_active">
                        <option value="" >Select Option</option>
                        <option value="1" <?php echo (isset($Newsearch_is_active) && $Newsearch_is_active=='1')?'selected':'';?>>Active</option>
                        <option value="0" <?php echo (isset($Newsearch_is_active) && $Newsearch_is_active=='0')?'selected':'';?>>Inactive</option>
                    </select></td>
            </tr> 
            <tr>
                <td>User Type:</td>
                <td><select name="user_type">
                        <option value="">Select User Type</option>
                        <option value="1" <?php echo (isset($user_type) && $user_type=='1')?'selected="selected"':'';?>>Post tasks</option>
                        <option value="2" <?php echo (isset($user_type) && $user_type=='2')?'selected="selected"':'';?>>Run tasks </option>
                        <option value="3" <?php echo (isset($user_type) && $user_type=='3')?'selected="selected"':'';?>>Both </option>
                    </select></td>   
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
                <th>Profile Image</th>
		<!--<th><?php echo $this->Paginator->sort('username'); ?></th>-->
		<th><?php echo $this->Paginator->sort('email'); ?></th>
		<th><?php echo $this->Paginator->sort('location'); ?></th>
		<th><?php echo $this->Paginator->sort('IP','Last IP'); ?></th>
		<th><?php echo $this->Paginator->sort('is_active','Activity Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
        $UserCnt=0;
        $uploadImgPath = WWW_ROOT.'user_images';
        foreach ($users as $user): 
            $UserCnt++;?>
	<tr>
		<td><?php echo $UserCnt;//echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>		
		<td><?php
                        $per_profile_img=isset($user['User']['profile_img'])?$user['User']['profile_img']:'';
                        if($per_profile_img!='' && file_exists($uploadImgPath . '/' . $per_profile_img)){
                            $ImgLink=$this->webroot.'user_images/'.$per_profile_img;
                        }else{
                            $ImgLink=$this->webroot.'user_images/default.png';
                        } 
                        echo '<img src="'.$ImgLink.'" alt="" height="100px" width="100px"/>';
                        ?></td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['location']); ?>&nbsp;</td>
                <td><?php echo isset($user['Activity'][0]['ip'])?$user['Activity'][0]['ip']:''; ?>&nbsp;</td>
		<td><?php echo h(($user['User']['is_active']==1)?'Active':'Inactive'); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Skills'), array('controller'=>'skills','action' => 'add', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Reviews Recieved'), array('controller'=>'ratings','action' => 'recieved', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Reviews Given'), array('controller'=>'ratings','action' => 'given', $user['User']['id'])); ?>
			<?php #echo $this->Html->link(__('Portfolio'), array('action' => 'portfolios','action'=>'add', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete %s?', $user['User']['username'])); ?>
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