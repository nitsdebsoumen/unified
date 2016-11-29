<?php
 //echo '<pre>',print_r($course);
 //die();

$slug='';
$url=Router::url($this->here, true);

$slug=substr($url, strrpos($url, '/') + 1);


$name=$user['User']['first_name'].' '.$user['User']['last_name'];

$user_image="";

if(isset($user['UserImage']['0']['originalpath']))
{
    $user_image=$user['UserImage']['0']['originalpath'];

    if (!file_exists($this->webroot."user_images/".$user_image))
    {
        $user_image='default.png';
    }
}
else
{
    $user_image='default.png';
}

?>

<div class="top-list-menu">
  <div class="menu">
  <ul>
      <li><a href="<?php echo $this->webroot; ?>"><?php echo HOME; ?></a></li>
        <li>></li>
        <li><a href="<?php echo $this->webroot.'users/profile/'.$slug; ?>"><?php echo "Featured Providers"; ?></a></li>
     <li>></li>
        <li><a href="#"><?php echo $name; ?></a></li>
    </ul>
    </div>
</div>


<section class="profile-top-area">

    <div class="profile-top">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-3">
                	<div class="profile-top-lt"><img src="<?php echo $this->webroot; ?>user_images/<?php echo $user_image;?>" width="200px" height="200px" alt=""></div>
                </div>
                <div class="col-md-9">
                	<div class="profile-top-rt">
                    	<h4><b><?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?></b></h4>
                        <p> <?php echo EMAIL_ID; ?> <?php echo $user['User']['email_address']; ?> </p>
                        <p><?php echo PHONE; ?><?php echo $user['User']['Phone_number']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="profile-text-area">
                        <h3><?php echo AVAILABLE_COURSES; ?></h3>

                        <div class="courses-area">
                        <div class="row serh_ruslt_box" style="height: 500px; overflow: scroll;" >

                         <?php foreach ($course as $course) { ?>


                                        <div class="media">
                                            <?php if($course['Post']['featured']==1){ ?>
                                                <span class="boxRibbon"><?php echo FEATURED; ?></span>
                                            <?php } ?>
                                                <div class="media-left media-middle">
                            <div class="img_hold">
                                <img alt="..." src="/team4/ladder/img/post_img/57834f1c80159.jpg" class="media-object">
                            </div>
                        </div>
                        <div class="media-body">
                            <b><?php echo $course['Post']['post_title'];?></b>
                            <span><?php echo $course['Post']['post_description'];?></span>
                            <p><?php //echo NEW; ?></p>
                            <ul>
                                <li><i class="fa fa-user"></i> <p> 1 Course available</p></li>
                                <li>
                                    <p><?php echo SHARE; ?></p> <a class="fa fa-linkedin" href=""></a> <a class="fa fa-facebook" href=""></a> <a class="fa fa-twitter" href=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="media-right media-middle">
                            <button class="normal"><i class="fa fa-graduation-cap"></i><?php if($course['Post']['type_of_course']==0){ echo CLASSROOM; }else { echo  'Online' ;} ?></button>
                            <button onclick="window.location.href='/team4/ladder/users/coursedetail/<?php echo $course['Post']['slug']; ?>'" class="more_info"><?php echo MORE_INFO; ?></button>
                        </div>
                    </div>

                    <?php  } ?>

                            <!--<div class="media">
                            <span class="boxRibbon">FEATURED</span>
                            <div class="media-left media-middle">
                            <div class="img_hold">
                                <img alt="..." src="/team4/ladder/img/post_img/57834f07b415b.jpg" class="media-object">
                            </div>
                        </div>
                        <div class="media-body">
                            <b>test</b>
                            <span>The Institute of Chartered Accountants in England and Wales</span>
                            <p> test </p>
                            <ul>
                                <li><i class="fa fa-user"></i> <p> 1 Course available</p></li>
                                <li>
                                    <p>Share:</p> <a class="fa fa-linkedin" href=""></a> <a class="fa fa-facebook" href=""></a> <a class="fa fa-twitter" href=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="media-right media-middle">
                            <button class="normal"><i class="fa fa-graduation-cap"></i> Classroom</button>
                            <button onclick="location.href='/team4/ladder/users/coursedetail/MTY2'" class="more_info">More Info</button>
                        </div>
                    </div>
                                        <div class="media">
                                                <span class="boxRibbon">FEATURED</span>
                                                <div class="media-left media-middle">
                            <div class="img_hold">
                                <img alt="..." src="/team4/ladder/img/post_img/578360544dca7.jpg" class="media-object">
                            </div>
                        </div>
                        <div class="media-body">
                            <b>Magento Course</b>
                            <span>The Institute of Chartered Accountants in England and Wales</span>
                            <p> Online Training Course for Magento </p>
                            <ul>
                                <li><i class="fa fa-user"></i> <p> 1 Course available</p></li>
                                <li>
                                    <p>Share:</p> <a class="fa fa-linkedin" href=""></a> <a class="fa fa-facebook" href=""></a> <a class="fa fa-twitter" href=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="media-right media-middle">
                            <button class="normal"><i class="fa fa-graduation-cap"></i> Classroom</button>
                            <button onclick="location.href='/team4/ladder/users/coursedetail/MTY3'" class="more_info">More Info</button>
                        </div>
                    </div>
                                        <div class="media">
                                                <span class="boxRibbon">FEATURED</span>
                                                <div class="media-left media-middle">
                            <div class="img_hold">
                                <img alt="..." src="/team4/ladder/img/post_img/1400610879_freelancing.png" class="media-object">
                            </div>
                        </div>
                        <div class="media-body">
                            <b>Course for beginer in PHP</b>
                            <span>The Institute of Chartered Accountants in England and Wales</span>
                            <p> PHP beginer or newbie. </p>
                            <ul>
                                <li><i class="fa fa-user"></i> <p> 1 Course available</p></li>
                                <li>
                                    <p>Share:</p> <a class="fa fa-linkedin" href=""></a> <a class="fa fa-facebook" href=""></a> <a class="fa fa-twitter" href=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="media-right media-middle">
                            <button class="normal"><i class="fa fa-graduation-cap"></i> Classroom</button>
                            <button onclick="location.href='/team4/ladder/users/coursedetail/MTcz'" class="more_info">More Info</button>
                        </div>
                    </div>-->

                </div>

            </div>


                   <!-- <div class="courses-area">
                        <div class="row">
                        <div class="col-md-1">
                        <div class="cor-pic">
                        <img src="<?php //echo $this->webroot; ?>images/cor-pic-a.jpg" alt=""></div>
                        </div>
                        <div class="col-md-11">
                        <h4>Lorem Ipsum is simply dummy text</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    </div>
                    </div>
                    </div>-->



                    </div>



                      <div class="profile-text-area">
                        <h3><?php echo OUR_REVIEWS; ?></h3>
                        <div class="our-review-area">

                             <div class="container">
        <div class="row">
            <div class="col-md-12">

            </div>
            <div class="col-md-12 latest-revw-slider">
                <ul class="bxslider3">
                    <?php
                    foreach($comments as $comment) :
                    ?>
                    <li>
                        <div class="latest-review-holding">
                            <!--<div class="main-image">
                                <img src="<?php echo $this->webroot . 'img/post_img/'. $comment['Post']['PostImage']['0']['originalpath']; ?>" alt="">
                            </div>-->
                            <aside>
                                <!--<div class="round-image"><img src="<?php echo $this->webroot; ?>images/face.jpg" alt=""> </div>-->
                                <div class="title"><?php echo $comment['Post']['post_title']; ?></div>
                                <p class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                <p class="descr">
                                    <?php
                                    if(strlen(strip_tags($comment['Comment']['message'])) > 100) {
                                        echo substr(strip_tags($comment['Comment']['message']), 0, 100) . '...';
                                    } else {
                                        echo strip_tags($comment['Comment']['message']);
                                    }
                                    ?>
                                </p>
                                <div class="name"><i><?php echo $comment['User']['first_name'] . ' ' . $comment['User']['last_name']; ?></i><br><?php echo LANG_CEO;?></div>
                                <p class="text-center"><a href="" class="btn btn-default"><?php echo READ_MORE; ?></a></p>
                            </aside>
                        </div>
                    </li>
                    <?php
                    endforeach;
                    ?>

                </ul>
            </div>
            <div class="col-md-12">
                <p class="text-center">
                    <!--<a href="" class="btn btn-default"><?php echo LIST_A_VENUE;?></a>
                    <a href="" class="btn btn-primary"><?php echo FIND_A_VENUE; ?></a>-->
                </p>
            </div>
        </div>
    </div>

                        </div>
                        </div>

                         <div class="profile-text-area">
                        <h3><?php echo OUR_LOCATIONS; ?></h3>
                        <div class="our-location-area">
                        <div class="row">
                        	<div class="col-md-3">
                        	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <?php
                            // Address
                            $address = $user['City']['name'].",".$user['State']['name'].",".$user['Country']['name'];

                            // Get JSON results from this request
                            $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

                            // Convert the JSON to an array
                            $geo = json_decode($geo, true);

                            if ($geo['status'] == 'OK') {
                            // Get Lat & Long
                            $latitude  = $geo['results'][0]['geometry']['location']['lat'];
                            $longitude = $geo['results'][0]['geometry']['location']['lng'];
                            }
                            ?>
                            <div class="col-md-9">
                            	<div id="googleMap" style="width:857px;height:323px;">
                                   <input type="hidden" id="lat" value="<?php echo $latitude; ?>" >
                                   <input type="hidden" id="lng" value="<?php echo $longitude; ?>" >
                                </div>

                            </div>
                            </div>
                        </div>
                        </div>

</section>



<script src="http://maps.googleapis.com/maps/api/js"></script>


<script>

var lat=$('#lat').val();
var lng=$('#lng').val();


var myCenter=new google.maps.LatLng(lat,lng);

function initialize()
{
var mapProp = {
center:myCenter,
zoom:13,
mapTypeId:google.maps.MapTypeId.ROADMAP
};

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker=new google.maps.Marker({
position:myCenter,
});

marker.setMap(map);

var infowindow = new google.maps.InfoWindow({
content:"<?php echo $address; ?>"
});

google.maps.event.addListener(marker, 'click', function() {
infowindow.open(map,marker);
});

}

google.maps.event.addDomListener(window, 'load', initialize);

</script>

