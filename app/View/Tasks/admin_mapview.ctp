<div class="users index">
<div style=" float:left; width: 70%;"><h2><?php echo __('Task Map View'); ?></h2></div>    
<div style="float:right;"><input type="button" value="List View" onclick="location.href='<?php echo $this->webroot;?>admin/tasks/list'"></div>
<div style="clear:both"></div>
<div id="mapview" style="height:700px;"></div>		
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script>
function initialize()

	{

    var locations = [<?php 
    $i=0;
    foreach($tasks as $task){
    
     if($i==0)
     {
       $lat= $task['Task']['lat'];
       $lang=$task['Task']['lang'];
     }
        
     ?>
    ['<?php echo $task['Task']['task_location']?>', '<?php echo $task['Task']['lat']?>', '<?php echo $task['Task']['lang'];?>', 4],

    <?php $i++;} ?>

    ];



    var map = new google.maps.Map(document.getElementById('mapview'), {

      zoom: 11,

      center: new google.maps.LatLng('<?php echo $lat?>', '<?php echo $lang;?>'),

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
 <script>
 $(document).ready(function(){
 initialize();    
 });    
 </script>


<?php //echo $this->element('admin_sidebar'); ?>
