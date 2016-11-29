<?php ?>
<script>
function start_show_map(){
    //alert('hi');
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



    var map = new google.maps.Map(document.getElementById('TaskMapView'), {

      zoom: 2,

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

/* window.onload = function() {
    start_show_map();
}; 
function start_show_map(){
    var myLatLng = {lat: -25.363, lng: 131.044};

        var map = new google.maps.Map(document.getElementById('mapview'), {
          zoom: 4,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });


}*/  
 </script>
 
 <script>
 $(document).ready(function(){
    //start();
    start_show_map();
    /*$(".map_marker").click(function () {
        $('#TaskMapView').style.display="block";
        start_show_map();
    });*/
 });    
 </script>
<?php
$ActiveActionNamed=$this->params['named'];
if(count($ActiveActionNamed)>0){
   $SortDirection=$ActiveActionNamed['direction'];
   $SortField=$ActiveActionNamed['sort'];   
}

if(isset($SortField) && $SortField=='id' && $SortDirection=='desc'){
   $IdSortName='Oldest to Newest Errands';
}elseif(isset($SortField) && $SortField=='id' && $SortDirection=='asc'){
   $IdSortName='Newest to OldestErrands';
}else{
   $IdSortName='Oldest to Newest Errands';
}

if(isset($SortField) && $SortField=='title' && $SortDirection=='desc'){
   $TitleSortName='Title A to Z';
}elseif(isset($SortField) && $SortField=='title' && $SortDirection=='asc'){
   $TitleSortName='Title Z to A';
}else{
   $TitleSortName='Title A to Z';
}

if(isset($SortField) && $SortField=='total_rate' && $SortDirection=='desc'){
   $TotalRateSortName='Lowest to Highest Price ';
}elseif(isset($SortField) && $SortField=='total_rate' && $SortDirection=='asc'){
   $TotalRateSortName='Highest to Lowest Price ';
}else{
   $TotalRateSortName='Lowest to Highest Price  ';
}
 
 //pr($ActiveAction);
?> 
<section class="main_body">
 		<div class="container">
 			<div class="row">
 				<?php echo $this->element('task_search'); ?>
 				
 				<div class="col-md-8 rev whit_bg">
 					<div class="right_dash_board user_task">
						<div class="result_task">
                                                    <h2><b><?php echo $this->Paginator->counter(array('format' => __('{:count}')));?><?php //echo count($TaskList);?> </b>Errands found</h2>
                                                    <span class="col-md-1" style="padding-top: 10px;">&nbsp;</span>
                                                    <div class="col-md-10 text-right" style="padding-top: 13px;">
                                                        <h2 style="padding: 0px; margin-top: 12px;">Sort By</h2>
                                                        <span class="btn btn-info"><?php echo $this->Paginator->sort('id',$IdSortName); ?></span>
                                                        <span class="btn btn-info"><?php echo $this->Paginator->sort('title',$TitleSortName); ?></span>
                                                        <span class="btn btn-info"><?php echo $this->Paginator->sort('total_rate', $TotalRateSortName); ?></span>
                                                        <span class="btn btn-info"><?php echo $this->Paginator->sort('post_date', 'Date'); ?></span>
                                                    </div>
                                                    <ul role="tablist" class="nav nav-tabs navbar-right">
                                                        <li class="active"><a data-toggle="tab" aria-controls="List" href="#List"><i class="fa fa-list-ul"></i></a></li>
                                                        <li><a data-toggle="tab" aria-controls="Posted" href="#Map" class="map_marker" onclick="start_show_map();"><i class="fa fa-map-marker"></i></a></li>
                                                    </ul>
 						</div>
						<div class="tab-content">
						    <div id="List" class="tab-pane active" role="tabpanel">
						    	<div class="task_lists">
									<ul class="media-list">
									<?php 
                                                if(count($TaskList)>0){
                                                    foreach($TaskList as $val){
                                                       $countAll = $this->requestAction('tasks/countall/'.$val['Task']['id']);  
                                                       //print_r($countAll);
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
                                                     <a href="<?php echo $this->webroot?>errands/detail/<?php echo base64_encode($val['Task']['id']);?>/<?php echo $val['Task']['seo_url'];?>"> <h4 class="media-heading"><?php echo $val['Task']['title'];?></h4> </a>
                                                     <p><i class="fa fa-map-marker"></i> <?php echo $val['Task']['task_location'];?></p>
                                                      <p><?php
                                                        if (strlen(strip_tags($val['Task']['description']))>180) {
                                                            echo substr(strip_tags($val['Task']['description']), 0,180).'...';
                                                        } else {
                                                            echo strip_tags($val['Task']['description']);

                                                        } 
                                                        ?></p>
                                                      <p><?php echo $countAll['comment'];?> Comments | <?php echo $countAll['offers'];?> offers | <i class="fa fa-eye"></i> <?php echo ($val['User']['is_login']==1)?'Online':'Offline';?> | <?php echo ($val['Task']['task_status']=='C')?'Complete':'Open';?> | <?php echo $val['Task']['workers'];?> People</p>
                                                    </div>
                                                    <div class="media-right">
                                                        <button>Earn $<?php echo $val['Task']['total_rate'];?></button>
                                                        
                                                    </div>
                                                  </li> 
                                                    
                                                <?php 
                                                    }
                                                }else{
                                                    echo '<li class="media"><p>No Errand found.</p></li> ';
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
                                <?php
                                    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                                    echo $this->Paginator->numbers(array('separator' => ''));
                                    echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                                ?>
                                </div>                               
                            </div>
                        </div>
                        <div id="Map" class="tab-pane" role="tabpanel">
                            <div id="TaskMapView" style="height:520px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style type="text/css">
.btn-info a {font-size:12px;}
</style>
