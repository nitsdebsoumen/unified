
<div class="listings form">
<?php echo $this->Form->create('Task'); ?>
	<fieldset>
            <legend><?php echo isset($this->params->pass[0])?'Edit':'Add'; ?>&nbsp;Task</legend>
            
		
	<?php
		echo $this->Form->input('id');
        ?>
        <div class="input text">
        <label for="Category">Category</label>
        <select name="data[Task][category_id]">
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
            <option value="<?php echo $category['Children'][$i]['id']?>" <?php if(isset($this->request->data['Task']['category_id']) and $this->request->data['Task']['category_id']==$category['Children'][$i]['id']){ ?>selected=""<?php } ?>><?php echo $category['Children'][$i]['name']?></option> 
            <?php } ?>
             <?php } ?>
            </optgroup> 
            <?php }?> 
        </select>
        
        
        
        </div>    
        <?php    
	echo $this->Form->input('title');
	echo $this->Form->input('description', array('type' => 'textarea'));
        ?>
                <div>
                    <input type="radio" name="data[Task][completed]" value="1" <?php if(isset($this->request->data['Task']['completed']) and $this->request->data['Task']['completed']==1 ){?>checked=""<?php }?> style="float:none;">To be completed in-person
                    <input type="radio" name="data[Task][completed]" value="2" <?php if(isset($this->request->data['Task']['completed']) and $this->request->data['Task']['completed']==2 ){?>checked=""<?php }?> style="float:none;">Can be completed online
                </div>
                
                
         <?php       
		echo $this->Form->input('task_location',array("required"=>"required",'id'=>'task_location'));
               
          ?>
          <div class="input text">
          <label for="TaskTaskLocation">Due date</label>
          </div>  
         <div>
             <input type="radio" name="data[Task][due_date_type]" value="1" <?php if(isset($this->request->data['Task']['due_date_type']) and $this->request->data['Task']['due_date_type']==1 ){?>checked=""<?php }?> style="float:none;" class="date_type">Today
             <input type="radio" name="data[Task][due_date_type]" value="2" <?php if(isset($this->request->data['Task']['due_date_type']) and $this->request->data['Task']['due_date_type']==2 ){?>checked=""<?php }?> style="float:none;" class="date_type">within 1 week
             <input type="radio" name="data[Task][due_date_type]" value="3" <?php if(isset($this->request->data['Task']['due_date_type']) and $this->request->data['Task']['due_date_type']==3 ){?>checked=""<?php }?> style="float:none;" class="date_type">by a certain day

         </div>
        
        <?php
        echo $this->Form->input('due_date',array("id"=>"due_date","type"=>"text","label"=>false));
        
        echo $this->Form->input('workers',array("required"=>"required",'label'=>'How many people need to be assigned to this task'));

        

        ?>
       <div class="input text">
          <label for="TaskTaskLocation">What's your budget?</label>
          </div>           
        <div>
             <input type="radio" name="data[Task][budget_type]" value="1" <?php if((isset($this->request->data['Task']['budget_type']) and $this->request->data['Task']['budget_type']==1) or empty($this->request->data) ){?>checked=""<?php }?> style="float:none;" class="budget_type">Total
             <input type="radio" name="data[Task][budget_type]" value="2" <?php if(isset($this->request->data['Task']['budget_type']) and $this->request->data['Task']['budget_type']==2 ){?>checked=""<?php }?> style="float:none;" class="budget_type">Hourly 

         </div>
                <div id="total_price_div" <?php if((isset($this->request->data['Task']['budget_type']) and $this->request->data['Task']['budget_type']==1) or empty($this->request->data)){?>style="display:block;" <?php }else{?>style="display:none;"<?php }?>>
                    $<input type="text" name="data[Task][total_rate]" style=" width:100px;" id="total_rate" <?php if((isset($this->request->data['Task']['budget_type']) and $this->request->data['Task']['budget_type']==1) or empty($this->request->data)){?>required="" <?php }?> value="<?php echo isset($this->request->data['Task']['total_rate'])?$this->request->data['Task']['total_rate']:'';?>">

         </div>
         <div id="hourly_price_div" <?php if(isset($this->request->data['Task']['budget_type']) and $this->request->data['Task']['budget_type']==2){?>style="display:block;" <?php }else{?>style="display:none;"<?php }?>>
         $<input type="text" name="data[Task][per_hour_rate]" style=" width:100px;"<?php if(isset($this->request->data['Task']['budget_type']) and $this->request->data['Task']['budget_type']==2){?>required="" <?php }?> id="per_hour_rate" value="<?php echo isset($this->request->data['Task']['per_hour_rate'])?$this->request->data['Task']['per_hour_rate']:''?>">&nbsp;per hour for
         <input type="text" name="data[Task][hour]" style=" width:100px;" id="hour" <?php if(isset($this->request->data['Task']['budget_type']) and $this->request->data['Task']['budget_type']==2){?>required="" <?php }?>  value="<?php echo isset($this->request->data['Task']['hour'])?$this->request->data['Task']['hour']:''?>"> &nbsp;hours

         </div>  
          <?php
          $options=array('2'=>'Approved','1'=>'Complete','0'=>'Archieve');
          echo $this->Form->input('status',array('options'=>$options,'selected'=>isset($this->request->data['Task']['status'])?$this->request->data['Task']['status']:''));
           $options=array("O"=>"Open","A"=>"Accepted","C"=>"Completed");
           echo $this->Form->input('task_status',array('options'=>$options,'selected'=>isset($this->request->data['Task']['task_status'])?$this->request->data['Task']['task_status']:''));

          ?>
                
            <?php
            if(isset($this->params->pass[0]) and $this->params->pass[0]!='')
            {
            ?>
            <button id="uploadBtn" type="button" class="btn btn-large btn-primary">Choose File</button> 
            <?php }?>
            <div style=" clear:both;"></div>
                <span id="Preview">
                 <?php
                 if(isset($this->request->data['TaskImage']))
                 {
                 
                        
                 ?>
                   
                        <?php
                        $counter=0;
                        for($i=0;$i< count($this->request->data['TaskImage']);$i++)
                        {
                        ?>
                    <div id="imageDiv_<?php echo $counter;?>" style="float:left; clear:none;">
                            <img src="<?php echo $this->webroot;?>task_images/<?php echo $this->request->data['TaskImage'][$i]['image_name'];?>" style="height:70px; width:70px; float:left;">
                            <a href="javascript:void(0)" onclick='return delImg2(<?php echo $counter;?>,"<?php echo $this->request->data['TaskImage'][$i]['image_name'];?>",<?php echo $this->request->data['TaskImage'][$i]['id']; ?>)'><img src='<?php echo $this->webroot; ?>img/close1.png' style='height:20px; width:20px;'></a>
                            <input type="hidden" name="task_image[]" value="<?php echo $this->request->data['TaskImage'][$i]['image_name']; ?>">
                            <input type="hidden" name="task_image_id[]" value="<?php echo $this->request->data['TaskImage'][$i]['id']; ?>">
                        </div>
                       <?php $counter++;}?>
                  
                
                 <?php }?>   
                    
                    
                    
                </span>
            <div id="pic-progress-wrap" class="progress-wrap" style="margin-top:10px;margin-bottom:10px;"></div>
            <div id="msgBox"></div>
	
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="<?php echo $this->webroot;?>uploader/SimpleAjaxUploader.js"></script>

<script>
  $(document).ready(function() {
  
  $(".date_type").click(function(){
  $("#due_date").attr("value","");    
  $date_type=$(this).val();
  if($date_type==3)
  {
    $("#due_date").addClass('datepicker');  
    $(".datepicker").datepicker({
    dateFormat:'yy-mm-dd'    
    });
  }
  else
  {
      $("#due_date").attr('class','');
  }
      
  });
  $(".budget_type").click(function(){
  $budget_type=$(this).val();
  if($budget_type==1)
  {
  $("#total_price_div").fadeIn();
  $("#total_rate").attr("required",true);
  $("#hourly_price_div").fadeOut();
  $("#per_hour_rate").removeAttr("required");
  $("#hour").removeAttr("required");
  $("#per_hour_rate").attr("value","");
  $("#hour").attr("value","");
  }
  else
  {
  $("#total_price_div").fadeOut();
  $("#hourly_price_div").fadeIn();
  $("#per_hour_rate").attr("required",true);
  $("#hour").attr("required",true);
  $("#total_rate").removeAttr("required"); 
  $("#total_rate").attr("value","")
  }
  
  
  
  });
  initialize();
});
    
window.onload = function() {
  var preview = $('#Preview');
  var outPut = '';
  var counter = $("#counter").val();
  var btn = document.getElementById('uploadBtn'),
      wrap = document.getElementById('pic-progress-wrap'),
      errBox = document.getElementById('msgBox');

  var uploader = new ss.SimpleUpload({
        dropzone: 'dragbox', 
        button: btn,
        progressUrl: '<?php echo $this->webroot;?>', 
        url: '<?php echo $this->webroot;?>uploader/file_upload.php', 
        responseType: 'json',
        name: 'uploadfile',
        multiple: true,
        maxUploads: 1,
        queue: true,
        timeout: 500,
        checkProgressInterval: 500,
        allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'], 
        hoverClass: 'ui-state-hover',
        focusClass: 'ui-state-focus',
        disabledClass: 'ui-state-disabled',
        data:{'_token':'{{{ csrf_token() }}}'},
        onSubmit: function(filename, extension) {
            
            var prog = document.createElement('div'),
            outer = document.createElement('div'),
            bar = document.createElement('div'),
            size = document.createElement('div'),
            self = this;     

            prog.className = 'prog';
            size.className = 'size';
            outer.className = 'progress';
            bar.className = 'bar';

            outer.appendChild(bar);
            prog.appendChild(size);
            prog.appendChild(outer);
            wrap.appendChild(prog); // 'wrap' is an element on the page

            self.setProgressBar(bar);
            self.setFileSizeBox(size);   
            self.setProgressContainer(prog);             

            errBox.innerHTML = '';
        
        },
        onSizeError: function() {
                errBox.innerHTML = 'Files may not exceed 2MB.';
        },
        onExtError: function() {
            errBox.innerHTML = 'Invalid file type. Please select a PNG, JPG, GIF image.';
        },
        onComplete: function(filename, response) {
            if (!response) {
              errBox.innerHTML = filename + 'upload failed.';
              return false;
            } 

            if (response.success === true) {
                //var outPut = "<div class='col-md-2' id='imageDiv_"+counter+"'><p><img src='{{asset('assets/property_photos')}}/"+response.file+"' height='74px' width='92px' class='borderOneblue'/></p><i class='fa fa-trash cursor' onclick='return delImg("+counter+",\""+response.file+"\")' style='z-index:999999'></i><input type='hidden' name='images[]' id='image_name_"+counter+"' value='"+response.file+"'><input type='hidden' name='image_cloud[]' id='image_cloud_"+counter+"' value='"+response.cloud+"'></div>";
                var outPut = "<div id=imageDiv_"+counter+" style='float:left; clear:none;'><img src='<?php echo $this->webroot;?>task_images/"+response.file+"' style='float:left;height:70px; width:70px;' /></p><a href='javascript:void(0)' onclick='return delImg("+counter+",\""+response.file+"\")'><img src='<?php echo $this->webroot; ?>img/close1.png' style='height:20px; width:20px;'></a><input type='hidden' name='task_image[]' id='image_name_"+counter+"' value='"+response.file+"'><input type='hidden' name=task_image_id[] value=''></div>";
                counter++;
                preview.append(outPut);

                $("#counter").attr("value",counter);
                return false;
            } else {
                if (response.msg)  {
                    errBox.innerHTML = response.msg;
                } else {
                    errBox.innerHTML = 'Unable to upload file';
                }
            } 
            
        }
});
}

function delImg(val,filename){
 if(confirm('Are you sure?')){
        $.post('<?php echo $this->webroot;?>uploader/remove.php?img='+filename,function(data){
            if(data=='Success'){
                $("#imageDiv_"+val).remove();
                return true;
            } else if(data=='Error') {
                return false;
            }
        })            
    } else {
        return false;
    }
}

function delImg2(val,filename,id){
 if(confirm('Are you sure?')){
        $.post('<?php echo $this->webroot;?>uploader/remove.php?img='+filename,function(data){
            if(data=='Success'){
                $("#imageDiv_"+val).remove();
                $.post("<?php echo $this->webroot;?>admin/tasks/delimg/"+id)
                return true;
            } else if(data=='Error') {
                return false;
            }
        })            
    } else {
        return false;
    }
}


  </script>
  <script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script>
CKEDITOR.replace( 'editor1',

 {

 	//filebrowserBrowseUrl : './ckfinder/ckfinder.html',

 	//filebrowserImageBrowseUrl : './ckfinder/ckfinder.html?type=Images',

 	filebrowserFlashBrowseUrl : '<?php echo $this->webroot;?>/ckfinder/ckfinder.html?type=Flash',
 	filebrowserUploadUrl : '<?php echo $this->webroot;?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
  	filebrowserImageUploadUrl: '<?php echo $this->webroot;?>/ckeditor/plugins/imgupload.php',
 	filebrowserFlashUploadUrl : '<?php echo $this->webroot;?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

 } 

 );
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
<style>
select {
    clear: both;
    font-family: "frutiger linotype","lucida grande","verdana",sans-serif;
    font-size: 140%;
    padding: 1%;
    width: 100%;
}    
</style>
