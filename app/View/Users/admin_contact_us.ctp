<?php
if(isset($_POST['submit'])) {
    echo 'Hi';
}
?>
<div class="users index">
    <h2 style="width:100%;float:left;"><?php echo __('Contact Us'); ?></h2>
    <div>
       <?php echo $this->Form->create("Contact");?>

        <table style=" border:none;">
            <tr>
                <td>Keyword</td>
                <td><input type="text" name="keyword" value="<?php echo isset($Keywords)?$Keywords:'';?>" placeholder="Search by Keyword."></td>
                <td>Date</td>
                <td><input type="text" name="ContactDate" id="datepicker" class="datepicker" value="<?php echo isset($ContactDate)?$ContactDate:'';?>" placeholder="Search by Date."></td>
                <td><input type="submit" name="search" value="Search"></td>
                 
             

    </div>

    <table cellpadding="0" cellspacing="0">
        <tr>
            <th style="width: 7%;"><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('email_address'); ?></th>
            <th><?php echo $this->Paginator->sort('subject'); ?></th>
            <th><?php echo $this->Paginator->sort('post_date'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>

	<?php foreach ($ContactUser as $key => $CUser): ?>
        <tr>
            <td><span><?php echo ++$key;//h($CUser['Contact']['id']); ?></span>&nbsp; <?php //if($CUser['Contact']['is_read']==0){ echo '<span class="notify">1</span>';}?></td>
            <td><?php echo h($CUser['Contact']['name']); ?>&nbsp;</td>
            <td><?php echo h($CUser['Contact']['email_address']); ?>&nbsp;</td>
            <td><?php echo h($CUser['Contact']['subject']); ?>&nbsp;</td>
            <td><?php echo h($CUser['Contact']['post_date']); ?>&nbsp;</td>
            <td >
                <?php
                /*$user_task_id=$CUser['Contact']['task_id']; 
                if($user_task_id >0 ){
                    $TaskStatus=$this->requestAction('users/task_details/'.$user_task_id);
                    if(isset($TaskStatus['Task']['task_status']) && $TaskStatus['Task']['task_status']=='A'){
                        echo $this->Form->postLink(__('Cancel Task'), array('action' => 'dispute_task', $user_task_id), null, __('Are you sure you want to cancel the task and refund the amount to client?', $TaskStatus['Task']['title']));
                    }
                }*/
                ?>

                <a href="javascript:void(0);" data-email="<?php echo h($CUser['Contact']['email_address']); ?>" data-subject="<?php echo h($CUser['Contact']['subject']); ?>" class=" btn btn-success btn-xs reply"> <i class="fa fa-reply"></i></a>

                 
                         <!--   <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $CUser['Contact']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>-->
                           
                            <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $CUser['Contact']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $CUser['Contact']['id'])); ?>
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


<!-- Modal -->
<div class="modal fade" id="contact_modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reply</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo $this->webroot . 'admin/users/contact_us'; ?>" method="post">
                    <div class="form-group">
                        <input type="text" name="to" value="" required="" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" value="" required="" />
                    </div>
                    <div class="form-group">
                        <textarea name="message" id="message" rows="6" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit" name="reply">Reply</button>
                    </div>
                    
                </form>
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>-->
        </div>

    </div>
</div>


<?php //echo $this->element('admin_sidebar'); ?>
<!--<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>

<style>
    .notify {
        background: red none repeat scroll 0 0;
        /*border-radius: 100%;*/
        color: #fff;
        font-size: 13px;
        margin-left: 6px;
        padding: 3px 8px;
    }
    .notify_success{
        background: #5BA150 none repeat scroll 0 0;
        /*border-radius: 100%;*/
        color: #fff;
        font-size: 13px;
        margin-left: 6px;
        padding: 3px 8px;
    }
</style>-->

<script>
    (function($){
        $('.reply').click(function(){
            var email = $(this).data('email');
            var subject = $(this).data('subject');
            $('input[name="to"]').val(email);
            $('input[name="subject"]').val(subject);
            $('#contact_modal').modal('show');
        });
    })(jQuery);
</script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('message',
            {
                width: "95%"
            });
</script>