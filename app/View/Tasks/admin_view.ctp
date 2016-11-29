
<?php
?>
<div class="users view">
<h2><?php echo __('Task'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($task['Task']['id']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Post Date'); ?></dt>
		<dd>
			<?php echo h($task['Task']['post_date']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Posted By'); ?></dt>
		<dd>
			<?php echo h($task['User']['first_name']); ?>
			&nbsp;	<?php echo h($task['User']['last_name']); ?>

		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($task['Task']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo strip_tags($task['Task']['description']); ?>
			&nbsp;
		</dd>
		<dt>Type of errand</dt>
		<dd>
			<?php echo $task['Task']['completed']==1?'To be completed in-person':'Can be completed online'; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Task Location'); ?></dt>
		<dd>
			<?php echo h($task['Task']['task_location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Due Date'); ?></dt>
		<dd>
			<?php echo h($task['Task']['due_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Workers'); ?></dt>
		<dd>
			<?php echo h($task['Task']['workers']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Budget Type'); ?></dt>
		<dd>
			<?php echo $task['Task']['budget_type']==1?'Total':'Hourly'; ?>
			&nbsp;
		</dd>
                
		
                <?php if($task['Task']['budget_type']==2){ ?>
                <dt><?php echo __('Hourly Rate'); ?></dt>
		<dd>
			<?php echo '$'.number_format(($task['Task']['per_hour_rate'])); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Hour'); ?></dt>
		<dd>
			<?php echo $task['Task']['hour']; ?>
			&nbsp;
		</dd>
                <?php } ?>
              <dt><?php echo __('Total'); ?></dt>
		<dd>
			<?php echo '$'.number_format(($task['Task']['total_rate'])); ?>
			&nbsp;
		</dd> 
                <!--<dt><?php echo __('Image'); ?></dt>
		<dd>
                    <ul style=" list-style-type:none; display:inline">
                        
                        <?php
                        if(isset($task['TaskImage']))
                        {
                        for($i=0;$i< count($task['TaskImage']);$i++)
                        {
                        ?>
                        <li><img src="<?php echo $this->webroot;?>task_images/<?php echo $task['TaskImage'][$i]['image_name']?>" style=" height:70px; width:70px;"></li>  
                       <?php }}?>
                        
                    </ul>
		</dd>-->  
                <dt><br></dt>
                <dd><br></dd>
                
		<?php
                $TaskID=$task['Task']['id'];
                $OfferList=$this->requestAction('tasks/offer_details_list/'.$TaskID);
                if(isset($OfferList) && count($OfferList)>0){
                    echo '<dt>Worker Give Offer</dt><dd>';
                    foreach($OfferList as $offVal){
                ?>
                <p><?php echo $offVal['User']['first_name'].' '.$offVal['User']['last_name']; ?> give offer <?php echo '$'.number_format(($offVal['Proposal']['amount'])); if($offVal['Proposal']['is_accepted']==1){ echo '&nbsp;&nbsp;<button>Accepted</button>';}?> </p>
                <p>Worker get amount $<?php echo $offVal['Proposal']['your_amount'];?><br>Admin get amount $<?php echo $offVal['Proposal']['site_amount'];?><br>Paypal fee $<?php echo $offVal['Proposal']['paypal_fee'];?></p>    
                <?php
                    }
                    echo '</dd>';
                }
                /*if($task['Task']['task_status']=='A'){
                    $TaskID=$task['Task']['id'];
                    $TaskStatus=$this->requestAction('users/job_details/'.$TaskID);
                        if(isset($TaskStatus) && count($TaskStatus)>0){
                    ?>
		<dt><?php echo __('Client Accept Offer'); ?></dt>
		<dd>
			<?php echo '$'.number_format(($TaskStatus['Job']['amount'])); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Action'); ?></dt>
		<dd>
			<?php echo $this->Form->postLink(__('Cancel Task'), array('action' => 'dispute_task', $TaskID), null, __('Are you sure you want to cancel the task and refund the amount to client?')); ?>
			&nbsp;
		</dd>
                <?php 
                        }
                    }*/
                ?>
	</dl>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
