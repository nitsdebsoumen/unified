<div class="users index">
    <div style="float:left; width:100%; "><h2 style="margin:0px;"><?php echo __('Task List('.$total_task.')'); ?></h2>
        
    <a href="<?php echo $this->webroot.'admin/tasks/export'; ?>" style="float:right">Export Tasks</a>
    </div>
    <div style="float:right;margin-top:10px;"><input type="button" value="Map View" onclick="location.href='<?php echo $this->webroot;?>admin/tasks/mapview'"></div>
    <div>
       <?php echo $this->Form->create("Filter",array('class' => 'filter'));?>
 
        <table style=" border:none;">
            <tr>
                <td>Keyword</td>
                <td><?php echo $this->Form->input("title",array('placeholder' => 'Search by Keyword.','label'=>false,'style'=>'padding:0'));?></td>
                <td>Ending On</td>
                <td><?php echo $this->Form->input("end_date_start",array('placeholder' => 'Start','label'=>false,'style'=>"width:150px;padding:0",'class'=>'datepicker'));?>
                <td><?php echo $this->Form->input("end_date_end",array('placeholder' => 'End','label'=>false,'style'=>"width:150px;padding:0",'class'=>'datepicker'));?>
                </td>
            </tr> 
            
            <tr>
                <td>Task Location</td>   
                <td><?php echo $this->Form->input("task_location",array('id'=>'task_location','label'=>false,'style'=>'width:300px;')); ?></td>
                <td>Online</td>   
                <td><?php echo $this->Form->input("completed",array('type' => 'checkbox','label'=>false,'value'=>1)); ?></td>
            </tr>
            <tr>
                <td>Category</td>   
                 <td>
                     <select name="data[Filter][category_id]">
                         <option value="">Filter By Category</option>
                        <?php
                        foreach($categories as $category){
                        ?>
                        <optgroup label="<?php echo $category['Category']['name']?>">
                        <?php
                        if(isset( $category['Children']))
                        {
                        for($i=0;$i<count($category['Children']);$i++) 
                        {
                        ?>
                            <option value="<?php echo $category['Children'][$i]['id']?>" <?php if(isset($this->request->data['Filter']['category_id']) and $this->request->data['Filter']['category_id']==$category['Children'][$i]['id']){echo 'selected';}?>   ><?php echo $category['Children'][$i]['name']?></option> 
                        <?php } ?>
                         <?php } ?>
                        </optgroup> 
                        <?php }?> 
                    </select>
                 </td>
                  <td><input type="submit" name="search" value="Search"></td>
                  

            </tr>
            </tr>
            <tr>
                <td>Number of Rows </td>
                <td>
                        <select name="data[Filter][rows]" id="rows" onchange="$('#FilterAdminListForm').submit()">
                                <option value="20" <?php if(isset($this->request->data['Filter']['rows']) and $this->request->data['Filter']['rows']==20){echo 'selected';}?> >20</option>
                                <option value="40" <?php if(isset($this->request->data['Filter']['rows']) and $this->request->data['Filter']['rows']==40){echo 'selected';}?>>40</option>
                                <option value="60" <?php if(isset($this->request->data['Filter']['rows']) and $this->request->data['Filter']['rows']==60){echo 'selected';}?>>60</option>
                                <option value="80" <?php if(isset($this->request->data['Filter']['rows']) and $this->request->data['Filter']['rows']==80){echo 'selected';}?>>80</option>
                                <option value="100" <?php if(isset($this->request->data['Filter']['rows']) and $this->request->data['Filter']['rows']==100){echo 'selected';}?>>100</option>
                        </select>
                </td>
            </tr>
        </table>
      <?php echo $this->Form->end();?>

    </div>
    <div>Send email to a person who has a task in drafts to remind them to complete the task. <button class="sendMail">Send Mail</button></div>  
    <form method="post" action="<?php echo $this->webroot.'admin/tasks/draft_mail_send'; ?>" id="SendMailFrm">
	<table cellpadding="0" cellspacing="0">
	<tr>
            <th><a href="Javascript: void(0);" class="CheckAll">Check All</a> &nbsp;</th>
            <th>SN<?php //echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('title'); ?></th>
            <th><?php echo $this->Paginator->sort('category_id'); ?></th>
            <th><?php echo $this->Paginator->sort('task_location'); ?></th>
            <th><?php echo $this->Paginator->sort('due_date','Ending On'); ?></th>
            <th><?php echo $this->Paginator->sort('status'); ?></th>
            <th><?php echo $this->Paginator->sort('task_status'); ?></th>
            <th><?php echo $this->Paginator->sort('completed','Online'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php 
        $UserCnt=0;
        $uploadImgPath = WWW_ROOT.'user_images';
        foreach ($tasks as $task):
            $per_profile_img=isset($task['User']['profile_img'])?$task['User']['profile_img']:'';
            if($per_profile_img!='' && file_exists($uploadImgPath . '/' . $per_profile_img)){
                $ImgLink=$this->webroot.'user_images/'.$per_profile_img;
            }else{
                $ImgLink=$this->webroot.'user_images/default.png';
            } 
            $UserCnt++;?>
	<tr>
            <td><input type="checkbox" name="TaskIdArr[]" value="<?php echo $task['Task']['id']; ?>" class="checkCheckBox">&nbsp;</td>
            <td><?php echo $UserCnt; ?>&nbsp;</td>
            <td><?php echo h($task['Task']['title']); ?>&nbsp;</td>
            <td><?php echo h($task['Category']['name']); ?>&nbsp;</td>
            <td><?php echo '<img src="'.$ImgLink.'" alt="" height="100px" width="100px"/>';?></td>
            <td><?php echo substr($task['Task']['task_location'],0,20); ?>&nbsp;</td>
            <td><?php echo h($task['Task']['due_date']); ?>&nbsp;</td>
            <td><?php echo $task['Task']['status']==1?'Complete':'Approved'; ?>&nbsp;</td>
            <td>
            Draft &nbsp;</td>
            <td><?php echo $task['Task']['completed']==1?'Yes':'No'?>&nbsp;</td>
            <td class="actions">
            <?php if($task['Task']['status']==1){echo $this->Html->link(__('Approve'), array('action' => 'approve', $task['Task']['id']));}?>
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $task['Task']['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'add', $task['Task']['id'])); ?>
                <?php #echo $this->Html->link(__('Comments'), array('action' => 'checkreview', $task['Task']['id'])); ?>
                <?php echo $this->Html->link(__('Review'), array('controller'=>'ratings','action' => 'index', $task['Task']['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $task['Task']['id']), null, __('Are you sure you want to delete %s?', $task['Task']['title'])); ?>
            </td>
	</tr>
<?php endforeach; ?>
	</table>
    </form>
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
<input type="hidden" id="TrigerChk" value="0">
<?php //echo $this->element('admin_sidebar'); ?>
<style>
select {
    clear: both;
    font-family: "frutiger linotype","lucida grande","verdana",sans-serif;
    font-size: 140%;
    padding: 1%;
    width: 100%;
}
form div{ padding:0px !important;}
</style>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
$(document).ready(function(){
    $(".datepicker").datepicker({
       dateFormat:'yy-mm-dd'    
       }); 
    initialize(); 
    $(".CheckAll").click(function () {
        var TrigerChk=$('#TrigerChk').val();
        if(TrigerChk==0){
            $( ".checkCheckBox" ).each(function(){
                $(this).attr('checked', 'checked');
            });
            $('#TrigerChk').val('1');
        }else{
            $( ".checkCheckBox" ).each(function(){
                $(this).removeAttr('checked');
            });
            $('#TrigerChk').val('0');
        }
    });
    
    $(".sendMail").click(function () {
        var TaskIdArrLen = $("[name='TaskIdArr[]']:checked").length;
        if(TaskIdArrLen>0){
            $('#SendMailFrm').submit();
        }else{
            alert('Please select a task to send email.');
            return false;
        }
    });
});    
</script>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<script type="text/javascript">
    
    function initialize() {
        var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(7.623887, 68.994141),
        new google.maps.LatLng(37.020098, 97.470703));

        var input1 = document.getElementById('task_location');
        var options = {
            bounds: defaultBounds,
            types: ['geocode'],
        };
        autocomplete1 = new google.maps.places.Autocomplete(input1, options);
    }
    
</script>
