<?php echo $this->element('user_menu'); ?>
<section class="main_body">
    <div class="container">
        <div class="row">
                <div class="col-md-3">
                    <?php echo $this->element('user_sidebar'); ?>
                </div>
                <div class="col-md-9">
                <div class="col-md-12 whit_bg">
                    
                    <div class="right_dash_board">
                        <h1>Edit Skills</h1>
                        <div id="cp_validation_err_msg"></div>
                        <?php 
                        echo $this->Form->create('Skill', array('class'=>'edit_profile')); 
                        echo $this->Form->input('id');
                        ?>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <?php echo $this->Form->input('skill_overview',array('type'=>'textarea','id'=>'skill_overview', 'class'=>'form-control', 'label'=> 'Skills Overview'));?>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <?php 
                                    $options=array('Bicycle'=>'Bicycle','Car'=>'Car','Online'=>'Online','Scooter'=>'Scooter','Truck'=>'Truck','Walk'=>'Walk');
                                    if(isset($this->request->data['Skill']['transportation'])){
                                        $selected=explode(",",$this->request->data['Skill']['transportation']);
                                    }else{
                                        $selected="";  
                                    }
                                    echo $this->Form->input('transportation',array('options'=>$options,'selected'=>$selected,'multiple'=>true, 'class'=>'form-control','style'=>'height:124px'));
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-6">
                                    <?php echo $this->Form->input('language',array('type'=>'text','id'=>'language', 'class'=>'form-control', 'label'=>'Languages Spoken'));?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo $this->Form->input('education',array('type'=>'text','id'=>'education', 'class'=>'form-control'));?>
                                </div>
                                <div class="clearfix"></div>
                                
                                <div class="form-group col-md-6">
                                    <?php echo $this->Form->input('work',array('type'=>'text','id'=>'work', 'class'=>'form-control', 'label'=> 'Work Experience'));?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo $this->Form->input('speciality',array('type'=>'text','id'=>'speciality', 'class'=>'form-control'));?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-12">
                                   <button type="submit">Save</button>
                                </div>
                            </div>
                        <?php echo $this->Form->end(); ?>
                    </div> 
                </div>

                              <div class="col-md-12 whit_bg">
                    
                    <div class="right_dash_board">
                        <h1>My CV</h1>
                        <div id="cp_validation_err_msg"></div>
                        <form class="edit_profile" method="post" action='<?php echo $this->webroot;?>users/portfolio'>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="col-md-3"><h3>Upload CV items</h3></div>
                                    <div class="col-md-6"><button id="uploadBtn" type="button" class="btn btn-large btn-primary">Choose File</button> </div>
                                </div>   
                                <div class="form-group col-md-12"><p>Upload your CV directly to your profile to showcase your talents! It's the perfect tool for photographers, designers and illustrators or you could also create a gallery of yourself completing tasks.</p>
                                    <p>You may upload a maximum of 30 items. File formats accepted include JPG/PNG/JPEG and must be no larger than 2MB.</p></div>
                                <div class="form-group col-md-12">
                                    <span id="Preview">
                                    <?php
                                    if(isset($user_portfolio) && count($user_portfolio)>0){
                                        //pr($user_portfolio);
                                        $counter=0;
                                        for($i=0;$i< count($user_portfolio);$i++){
                                    ?>
                                        <div id="imageDiv_<?php echo $counter;?>" style="float:left; clear:none;">
                                            <img src="<?php echo $this->webroot;?>portfolio/<?php echo $user_portfolio[$i]['PortfolioImage']['image_name'];?>" style="height:70px; width:70px; float:left;">
                                            <a href="javascript:void(0)" onclick='return delImg2(<?php echo $counter;?>,"<?php echo $user_portfolio[$i]['PortfolioImage']['image_name'];?>",<?php echo $user_portfolio[$i]['PortfolioImage']['id']; ?>)'><img src='<?php echo $this->webroot; ?>img/close1.png' style='height:20px; width:20px;'></a>
                                            <input type="hidden" name="task_image[]" value="<?php echo $user_portfolio[$i]['PortfolioImage']['image_name']; ?>">
                                            <input type="hidden" name="task_image_id[]" value="<?php echo $user_portfolio[$i]['PortfolioImage']['id']; ?>">
                                        </div>
                                        <?php 
                                        $counter++;
                                        }
                                    }
                                    ?>   
                                    </span>
                                    <div id="pic-progress-wrap" class="progress-wrap" style="margin-top:10px;margin-bottom:10px;"></div>
                                    <div id="msgBox"></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-12">
                                   <button type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>

            </div>
        </div>
    </div>
</section>
<link href="<?php echo $this->webroot;?>css/jquery.tagit.css" rel="stylesheet" type="text/css">
<link href="<?php echo $this->webroot;?>css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
<script src="<?php echo $this->webroot;?>js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<!-- The real deal -->
<script src="<?php echo $this->webroot;?>js/tag-it.min.js" type="text/javascript" charset="utf-8"></script>

<script>
    $(function(){
        $('#speciality,#language,#education,#work').tagit({
        });
    });
</script>

<script src="<?php echo $this->webroot;?>uploader/SimpleAjaxUploader.js"></script>

<script>
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
        url: '<?php echo $this->webroot;?>uploader/portfolio_file_upload.php', 
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
                var outPut = "<div id=imageDiv_"+counter+" style='float:left; clear:none;'><img src='<?php echo $this->webroot;?>portfolio/"+response.file+"' style='float:left;height:70px; width:70px;' /><a href='javascript:void(0)' onclick='return delImg("+counter+",\""+response.file+"\")'><img src='<?php echo $this->webroot; ?>img/close1.png' style='height:20px; width:20px;'></a><input type='hidden' name='task_image[]' id='image_name_"+counter+"' value='"+response.file+"'><input type='hidden' name=task_image_id[] value=''></div>";
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
        $.post('<?php echo $this->webroot;?>uploader/portfolio_remove.php?img='+filename,function(data){
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
        $.post('<?php echo $this->webroot;?>uploader/portfolio_remove.php?img='+filename,function(data){
            if(data=='Success'){
                $("#imageDiv_"+val).remove();
                $.post("<?php echo $this->webroot;?>users/delimg/"+id)
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
