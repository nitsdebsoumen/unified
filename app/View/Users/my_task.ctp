<?php ?>
<script>
function start(){
    //alert('hii');
    var locations = [<?php 
    $i=0;
    foreach($TaskList as $task){
    
     if($i==0)
     {
       $lat= $task['Task']['lat'];
       $lang=$task['Task']['lang'];
     }
        
     ?>
    ['<?php echo $task['Task']['task_location']?>', '<?php echo $task['Task']['lat']?>', '<?php echo $task['Task']['lang'];?>', 4],

    <?php $i++;} ?>

    ];

    var map = new google.maps.Map(document.getElementById('mapview_my_task'), {
      zoom: 10,
      center: new google.maps.LatLng('<?php echo $lat?>', '<?php echo $lang;?>'),
      //mapTypeId: 'roadmap'
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
}
        
 </script>
 <?php
 $ActiveActionNamed=$this->params['named'];
 if(count($ActiveActionNamed)>0){
    $SortDirection=$ActiveActionNamed['direction'];
    $SortField=$ActiveActionNamed['sort'];   
 }
 
 ?>

 <?php echo $this->element('user_menu'); ?>
<section class="main_body">
    <div class="container">
            <div class="row">
                    <div class="col-md-3">
                            <?php echo $this->element('user_sidebar'); ?>
                    </div>
                    <div class="col-md-9">
                      <div class="whit_bg">
                        <div class="right_dash_board1">
                                <div class="search_box">
                                        <h2>MY ERRANDS POSTED</h2>
                                        <form name="searchTask" method="post" action="">
                                        <div class="row" style="margin:0 auto;">
                                                <div class="form-group col-md-4 pad_0">
                                                    <label for="Keywords">Search my errand by keywords</label>
                                                    <input type="text" class="form-control" name="Keywords" id="Keywords" placeholder="Keywords" value="<?php echo isset($Keywords)?$Keywords:'';?>">
                                                </div>
                                                <div class="form-group col-md-2 pad_0">
                                                    <label for="Price">Price Min</label>
                                                    <input type="number" class="form-control" name="Price_Min"  placeholder="Price MIN" value="<?php echo isset($Price_Min)?$Price_Min:'';?>" >
                                                </div>
                                                <div class="form-group col-md-2 pad_0">
                                                    <label for="Price">Price Max</label>
                                                    <input type="number" class="form-control" name="Price_Max"  placeholder="Price MAX" value="<?php echo isset($Price_Max)?$Price_Max:'';?>" >
                                                </div>
                                                <div class="form-group col-md-2 pad_0">
                                                    <label for="worktype">Work Type</label>
                                                    <select name="WorkType" class="form-control" id="worktype">
                                                        <option value="">Select Option</option>
                                                        <option value="1" <?php echo ($WorkType=='1')?'selected="selected"':'';?>>Online</option>
                                                        <option value="2" <?php echo ($WorkType=='2')?'selected="selected"':'';?>>In person</option>
                                                    </select>
                                                </div>
                                                <!--<div class="form-group col-md-2 pad_0">
                                                    <label for="TaskStatus">Status</label>
                                                    <select name="TaskStatus" class="form-control" id="TaskStatus">
                                                        <option value="">Select Option</option>
                                                        <option value="O" <?php echo ($TaskStatus=='O')?'selected="selected"':'';?>>Open</option>
                                                        <option value="A" <?php echo ($TaskStatus=='A')?'selected="selected"':'';?>>Accepted</option>
                                                        <option value="C" <?php echo ($TaskStatus=='C')?'selected="selected"':'';?>>Complete</option>
                                                    </select>
                                                </div>-->
                                                <div style=" clear:both;"></div>

                                                <div class="form-group col-md-2 pad_0">
                                                    <label for="EndDate">Due Date</label>
                                                    <input type="text" class="form-control" name="EndDate" id="EndDate" placeholder="2016-12-25" value="<?php echo isset($EndDate)?$EndDate:'';?>">
                                                </div>
                                                <div class="form-group col-md-2 pad_0">
                                                    <label for="EndDate">Category</label>
                                                    <select name="Category" class="form-control">
                                                      <option value="">Filter By Category</option>
                                                           <?php
                                                           foreach($categories_lists as $cat_list){
                                                           ?>
                                                           <!--<optgroup label="<?php echo $cat_list['Category']['name']?>">-->
							   <option class="optionGroup" value="<?php echo $cat_list['Category']['id']?>" <?php if(isset($Category) and $Category==$cat_list['Category']['id']){echo 'selected';}?>   ><?php echo $cat_list['Category']['name']?></option>
                                                           <?php
                                                           if(isset( $cat_list['Children']))
                                                           {
                                                           for($i=0;$i<count($cat_list['Children']);$i++) 
                                                           {
                                                           ?>
                                                           <option class="optionChild" value="<?php echo $cat_list['Children'][$i]['id']?>" <?php if(isset($Category) and $Category==$cat_list['Children'][$i]['id']){echo 'selected';}?>   ><?php echo $cat_list['Children'][$i]['name']?></option> 
                                                           <?php } ?>
                                                           <?php } ?>
                                                           <!--</optgroup> -->
                                                           <?php }?> 
                                                       </select>
                                                </div>
                                                <div class="form-group col-md-2 pad_0">
                                                    <label for="Location">Location</label>
                                                    <input type="text" class="form-control" name="task_location" value="<?php echo isset($task_location)?$task_location:'';?>" id="Search_task_location" style="width:270px;">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    &nbsp;
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <button type="submit">SEARCH</button>
                                                </div>
                                        </div>
                                        </form>
                                </div>
                                <div class="result_task">
                                    <h2 style="margin-top: 11px !important;"><b><?php echo $this->Paginator->counter(array('format' => __('{:count}')));?></b> Result found</h2>
                                    <span class="col-md-1" style="padding-top: 10px;"><a href="<?php echo $this->webroot?>users/my_errand"><button class="btn btn-warning">OPEN</button></a></span>
                                    <span class="col-md-1" style="padding-top: 10px; padding-left: 0px; margin-right: 14px; margin-left: 16px;"><a href="<?php echo $this->webroot?>users/my_errand/assigned"><button class="btn btn-info">ASSIGNED</button></a></span>
                                    <span class="col-md-2" style="padding-top: 10px; padding-right: 0px; width: 14% !important;"><a href="<?php echo $this->webroot?>users/my_errand/complete"><button class="btn btn-success">COMPLETE</button></a></span>
                                    <span class="col-md-1" style="padding-top: 10px; padding-left: 4px;"><a href="<?php echo $this->webroot?>users/my_task/draft"><button class="btn btn-danger">DRAFT</button></a></span>
                                    <span class="col-md-4 text-right" style="padding-top: 10px;">
                                        <h2 style="margin-top: 8px !important; padding-left: 10px;">Sort By</h2>
                                        <span class="col-md-8">
                                            <select name="SortTaskData" id="SortTaskData" class="form-control">
                                            <option value="">Select One</option>  
                                            <option value="sort:id/direction:desc" <?php if(isset($SortField) && $SortField=='id' && $SortDirection=='desc'){ echo 'selected="selected"';}?> >Newest to oldest</option>
                                            <option value="sort:id/direction:asc" <?php if(isset($SortField) && $SortField=='id' && $SortDirection=='asc'){ echo 'selected="selected"';}?>>Oldest to Newest</option>
                                            <option value="sort:title/direction:asc" <?php if(isset($SortField) && $SortField=='title' && $SortDirection=='asc'){ echo 'selected="selected"';}?>>Title A to Z</option>
                                            <option value="sort:title/direction:desc" <?php if(isset($SortField) && $SortField=='title' && $SortDirection=='desc'){ echo 'selected="selected"';}?>>Title Z to A</option>
                                            <option value="sort:total_rate/direction:asc" <?php if(isset($SortField) && $SortField=='total_rate' && $SortDirection=='asc'){ echo 'selected="selected"';}?>>Price Low to High</option>
                                            <option value="sort:total_rate/direction:desc" <?php if(isset($SortField) && $SortField=='total_rate' && $SortDirection=='desc'){ echo 'selected="selected"';}?>>Price High to Low</option>
                                            <option value="sort:post_date/direction:asc" <?php if(isset($SortField) && $SortField=='post_date' && $SortDirection=='asc'){ echo 'selected="selected"';}?>>Date</option>
                                            </select>
                                        </span>
                                        <!--<span class="btn btn-info"><?php echo $this->Paginator->sort('title'); ?></span>
                                        <span class="btn btn-info"><?php echo $this->Paginator->sort('total_rate', 'Price'); ?></span>
                                        <span class="btn btn-info"><?php echo $this->Paginator->sort('post_date', 'Date'); ?></span>-->
                                    </span>
                                    <ul class="nav nav-tabs navbar-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#List" aria-controls="List" role="tab" data-toggle="tab"><i class="fa fa-list-ul"></i></a></li>
                                        <li role="presentation"><a href="#Map" aria-controls="Posted" role="tab" data-toggle="tab" onclick="start();"><i class="fa fa-map-marker"></i></a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="List">
                                        <div class="task_lists">
                                                <ul class="media-list">
                                                <?php 
                                                if(count($TaskList)>0){
                                                    foreach($TaskList as $val){
                                                    $countAll = $this->requestAction('tasks/countall/'.$val['Task']['id']);
                                                ?>
                                                   <li class="media">
                                                    <div class="media-left">
                                                      <a href="<?php echo $this->webroot?>errands/detail/<?php echo base64_encode($val['Task']['id']);?>/<?php echo $val['Task']['seo_url'];?>">
                                                        <?php 
                                                          $UserProfile_img=isset($val['User']['profile_img'])?$val['User']['profile_img']:'';
							   $uploadImgPath = WWW_ROOT.'user_images';
							   if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
								  echo '<img src="'.$this->webroot.'user_images/'.$UserProfile_img.'" alt="" />';
							   }else{
								  echo '<img src="'.$this->webroot.'user_images/default.png" alt="" />';
							   }
                                                        ?>
                                                      </a>
                                                    </div>
                                                    <div class="media-body">
                                                       <a href="<?php echo $this->webroot?>errands/detail/<?php echo base64_encode($val['Task']['id']);?>/<?php echo $val['Task']['seo_url'];?>"><h4 class="media-heading"><?php echo $val['Task']['title'];?></h4></a>
                                                       <p><i class="fa fa-map-marker"></i> <?php echo $val['Task']['task_location'];?></p>
                                                      <p><?php
                                                        if (strlen(strip_tags($val['Task']['description']))>180) {
                                                            echo substr(strip_tags($val['Task']['description']), 0,180).'...';
                                                        } else {
                                                            echo strip_tags($val['Task']['description']);

                                                        } 
                                                        ?></p>
                                                        <?php if($val['Task']['status']==0)
                                                        		{$stat='DRAFT';}
                                                        		else{
                                                        			if($val['Task']['task_status']=='O')$stat='OPEN';
                                                        			if($val['Task']['task_status']=='A')$stat='ASSIGNED';
                                                        			if($val['Task']['task_status']=='C')$stat='COMPLETE';
                                                        		}?>
                                                      <p><?php echo $countAll['comment'];?> Comments | <?php echo $countAll['offers'];?> offers | <?php echo '<b>'.$stat.'</b>';?> | <i class="fa fa-eye"></i> <?php echo ($val['Task']['completed']==1)?'Online':'Offline';?> | <?php echo $val['Task']['workers'];?> People</p>
                                                    </div>
                                                    <div class="media-right">
                                                        <button><?php if($stat=='OPEN'){ echo 'Earn $'.$val['Task']['total_rate'];}else{ echo $stat;}?></button>
                                                        <?php
                                                        if($val['Task']['task_status']=='C'){
                                                        ?>
                                                        <a href="<?php echo $this->webroot?>users/repeat_task/<?php echo base64_encode($val['Task']['id']);?>" style="color: #fff;"><button type="button" style="margin-top: 5px;">Repeat Task</button></a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                  </li> 
                                                    
                                                <?php 
                                                    }
                                                }else{
                                                    echo '<li class="media"><p>No Task found.</p></li> ';
                                                }
                                                ?>
                                                </ul>
                                            
                                                <p>
                                                <?php
                                                echo $this->Paginator->counter(array(
                                                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                                                ));
                                                ?>	
                                                </p>
                                                <div class="paging">
                                                    <!--<ul class="pagination">
                                                        <li><a href="#">1</a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#">4</a></li>
                                                        <li><a href="#">5</a></li>
                                                    </ul>-->
                                                <?php
                                                        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                                                        echo $this->Paginator->numbers(array('separator' => ''));
                                                        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                                                ?>
                                                </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="Map">
                                        <div class="map">
                                            <div id="mapview_my_task" style="height: 520px;"></div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                      </div>
                    </div>
            </div>
    </div>
</section>

<style>
.optionGroup
{
    font-weight:bold;
    font-style:italic;
}

.optionChild
{
    padding-left:15px;
}
</style>
<script type="text/javascript">
    
    function initialize2() {
        var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(7.623887, 68.994141),
        new google.maps.LatLng(37.020098, 97.470703));

        var input1 = document.getElementById('Search_task_location');
        var options = {
            bounds: defaultBounds,
            types: ['geocode'],
        };
        autocomplete1 = new google.maps.places.Autocomplete(input1, options);
    }
    
</script>

<script type="text/javascript">
    $(document).ready(function(){       
        $('#EndDate').datepicker({dateFormat: 'yy-mm-dd'});
        initialize2();
        //start();
        $( "#SortTaskData" ).change(function() {
            var SortData=$(this).val();
            var currenturl = $(location).attr('href');
            //var currenturl = '<?php echo $this->webroot?>users/my_task';
            if(SortData!=''){
                if(currenturl.indexOf("direction") >= 0){
                    var OldcurrenturlSplit = currenturl.split('//');
                    var currenturlSplit = OldcurrenturlSplit[1].split('/');
                    var SortDataSplit = SortData.split('/');
                    var sort_data=SortDataSplit[0];
                    var direction_data=SortDataSplit[1];
                    var search = new RegExp('direction' , "i");
                    var directionarr = $.grep(currenturlSplit, function (e) {
                            return search.test(e);
                            }
                        );
                    var sortsearch = new RegExp('sort' , "i");
                    var sortarr = $.grep(currenturlSplit, function (e) {
                            return sortsearch.test(e);
                        });
                    $.each( currenturlSplit, function( key, value ) {
                        if(sortarr==value){
                            currenturlSplit[key]=sort_data;
                        }else if(directionarr==value){
                            currenturlSplit[key]=direction_data;
                        }
                        
                    });
                    var NewcurrenturlSplit=currenturlSplit.join( "/" ) 
                    window.location = 'http://'+NewcurrenturlSplit;
                }else{
                    window.location = currenturl+'/'+SortData;
                }
            }else{
                window.location = currenturl;
            }
            
            
        });
    });
</script>

