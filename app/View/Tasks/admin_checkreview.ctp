
<?php
?>
<div class="users view">
<h2><?php echo __('Comment'); ?></h2>
<a href="<?php echo $this->webroot.'admin/tasks/exportreview/'.$task_id; ?>" style="float:right">Export</a>

	<dl>
            
            <dt><?php echo __('Overall Rateing'); ?></dt>
		<dd>
			<?php
                    $star="";
                    for($i=1;$i<=$avg_score;$i++)
                    {
                    $star.="<img src='".$this->webroot."img/star.png'/>";    
                    ?>
                    <?php 
                    
                    }
                    echo $star;
                    
                    ?>
			&nbsp;
		</dd>
            <?php
            foreach($reviews as $review)
            {
            ?>
           <div style=" margin-top:1px; ">&nbsp;</div>
    
            <dt>Name:</dt>
		<dd>
                    <div style="float:left;">
                    <?php echo h($review['User']['first_name']); ?>&nbsp;<?php echo h($review['User']['last_name']); ?>
			&nbsp;</div>
                    <div style=" float:left;">
                        <?php
                        if(isset($review['User']['profile_img']) and !empty($review['User']['profile_img']) )
                        {
                        ?>
                        <img alt="" src="<?php echo $this->webroot;?>user_images/<?php echo $review['User']['profile_img'];?>" style=" height:60px; width:60px;">
                        <?php
                        }else{
                        ?>
                       <img alt="" src="<?php echo $this->webroot;?>user_images/default.png" style=" height:60px; width:60px; border-radius:4px;">

                        <?php }?></div>
                        
		</dd>
                
                
                <dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($review['Comment']['review']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Attachments'); ?></dt>
		<dd>
			<?php
                        if(isset($review['Comment']['file']) and !empty($review['Comment']['file']))
                        { 
                        ?>
                    <img src="<?php echo $this->webroot;?>comment_file/<?php echo $review['Comment']['file'];?>" style=" height:60px; width:60px;">
                        <?php }else{ ?>
                    <img src="<?php echo $this->webroot;?>noimage.png" style=" height:60px; width:60px;">
                        <?php }?>
                    
			&nbsp;
		</dd>
                
                <dt><?php echo __('Posted On'); ?></dt>
		<dd>
			<?php echo h($review['Comment']['create_time']); ?>
			&nbsp;
		</dd>
                <div style=" margin-top:3px; ">&nbsp;</div>
                <hr>
            <?php } ?>
                
		
	</dl>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
