<style>
.catgry-box {
    min-height: 280px !important;

}
</style>
<?php echo $this->Session->flash(); ?>
<div class="home-banner">
    <div class="carousel-caption">
        <h1><?php echo GET_BOOST_UP; ?></h1>
        <p><?php echo YOUR_UNIQUE; ?><br/><?php echo NETWORK_TO_INDUSTRY; ?></p>
        <div class="search_section">
            <?php
            //pr($categories);
            echo $this->Form->create(false, array(
                'url'   => array('controller' => 'users', 'action' => 'search'),
                'type'  => 'get',
                'class' => 'form-inline'
            ));
            ?>
                <div class="form-group">
                    <div class="input-group">
                        <select class="form-control" name="cat">
                            <option value="">Category</option>
                            <?php
                            foreach ($categories as $cat_option) {
                                echo '<option value="' . $cat_option['Category']['id'] . '">' . $cat_option['Category']['category_name'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="input-group-addon">
                            <input type="text" name="keyword" placeholder="<?php echo SEARCH_FOR_COURCES;?>" />
                        </div>
                        <div class="input-group-addon">
                            <button type="submit"><?php echo SEARCH; ?></button>
                        </div>
                    </div>
                </div>
            <?php
            echo $this->Form->end();
            ?>
        </div>
    </div>
    <ul class="bxslider">
        <?php
        if(!empty($homesliders)) :
            foreach($homesliders as $slider) :
        ?>
        <li>
            <img src="<?php echo $this->webroot . 'homeslider/' . $slider['Homeslider']['image']; ?>" alt="" />
        </li>
        <?php
            endforeach;
        endif;
        ?>
    </ul>
</div>

<section class="our-stat">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span><?php echo OUR; ?></span> <?php echo STATISTICS;?></h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/stat-border.png" alt=""></p>
            </div>
            <div class="col-sm-4 text-center">
                <div class="stat-box">
                    <img src="<?php echo $this->webroot; ?>images/stat-1.png" alt="">
                    <h1><?php echo $courses_count; ?></h1>
                    <p><?php echo AVAILABLE_COURSES; ?></p>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="stat-box">
                    <img src="<?php echo $this->webroot; ?>images/stat-2.png" alt="">
                    <h1><?php echo $count_providers; ?></h1>
                    <p><?php echo TOTAL_PROVIDERS; ?></p>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="stat-box">
                    <img src="<?php echo $this->webroot; ?>images/stat-2.png" alt="">
                    <h1><?php echo $courses_booked_count; ?></h1>
                    <p><?php echo COURSES_BOOKED; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="how_it_works" style="background:url(images/how-it-bg.jpg);background-repeat: no-repeat; background-position: top center; background-size: cover">
    <div class="container">
        
        <?php echo $how_it_works['CmsPage']['page_description']; ?>
        
<!--        <div class="row">
            <div class="col-md-12">
                <h1><span>How</span> it works</h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/how-border.png" alt=""></p>
                <h4 class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type .</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs how-tab" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Provider</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Student</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                        <div class="graphic-section">
                            <ul>
                                <li>
                                    <aside>
                                        <div class="round-graphic">
                                            <img src="<?php echo $this->webroot; ?>images/graphic-1.png" alt="">
                                        </div>
                                        <h1>Dream</h1>
                                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                        <div class="line"></div>
                                    </aside>
                                </li>
                                <li>
                                    <aside>
                                        <div class="round-graphic">
                                            <img src="<?php echo $this->webroot; ?>images/graphic-2.png" alt="">
                                        </div>
                                        <h1>Creat</h1>
                                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                        <div class="line"></div>
                                    </aside>
                                </li>
                                <li>
                                    <aside>
                                        <div class="round-graphic">
                                            <img src="<?php echo $this->webroot; ?>images/graphic-3.png" alt="">
                                        </div>
                                        <h1>Tech</h1>
                                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                        <div class="line"></div>
                                    </aside>
                                </li>
                                <li>
                                    <aside>
                                        <div class="round-graphic">
                                            <img src="<?php echo $this->webroot; ?>images/graphic-4.png" alt="">
                                        </div>
                                        <h1>Earn</h1>
                                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                        <div class="line"></div>
                                    </aside>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">bbb</div>

                </div>
            </div>
        </div>-->
    </div>
</section>

<section class="featured">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <h1><span><?php echo FEATURED; ?></span><?php echo ' '.COURSES; ?></h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/feature-border.png" alt=""></p>
            </div>
            <ul class="bxslider12">
            <?php foreach($featured_courses as $featured_course ) : 
            $id=$featured_course['Post']['id'];

            ?>
            <li>
              <div class="featured-box" style="cursor:pointer; min-height: 355px;" onclick="javascript:window.location.href='<?php echo $this->webroot; ?>users/coursedetail/<?php echo base64_encode($id) ?>'" >
                    <?php
                    if($featured_course['PostImage']['0']['originalpath'] != '') {
                        $background = 'style="background: url('.$this->webroot . 'img/post_img/'. $featured_course['PostImage']['0']['originalpath'].'); background-size: 100%;"';
                    } else {
                        $background = '';
                    }
                    ?>
                    <div class="square-box square-box-1" <?php echo $background; ?>></div>
                    
                    <h3><?php echo $featured_course['Post']['post_title']; ?></h3>
                    
                    <p>
                    <?php
                    if(strlen(strip_tags($featured_course['Post']['post_description'])) > 100) {
                        echo substr(strip_tags($featured_course['Post']['post_description']), 0, 100) . '...';
                    } else {
                        echo substr(strip_tags($featured_course['Post']['post_description']), 0, 100);
                    }
                    ?>
                    </p>
                </div>
            </li>
            <?php endforeach; ?>
            </ul>
<!--            <div class="col-sm-4">
                <div class="featured-box">
                    <div class="square-box square-box-2"></div>
                    <h3>Photoshop</h3>
                    <p>Lorem Ipsum has been the industry's standard.</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="featured-box">
                    <div class="square-box square-box-3"></div>
                    <h3>Photoshop</h3>
                    <p>Lorem Ipsum has been the industry's standard.</p>
                </div>
            </div>-->
            
            
        </div>
    </div>
</section>

<section class="catgry">
    <div class="container" >
        <div class="row"  >

            <div class="col-md-12">
                <h1><span><?php echo CATEGORIES; ?></span> </h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/catgry-border.png" alt=""></p>
            </div>
           
            <?php
            foreach($categories as $category) :
             $catid=$category['Category']['id'];
                if($category['CategoryImage']['0']['originalpath']) {
                    $cat_image = $this->webroot . 'img/cat_img/'. $category['CategoryImage']['0']['originalpath'];
                } else {
                    $cat_image = $this->webroot . 'images/i-1.png';
                }
            ?>
            <div class="col-sm-3 "  style="cursor:pointer;" onclick="javascript:window.location.href='<?php echo $this->webroot; ?>users/coursefilter/<?php echo base64_encode($catid) ?>'" >
                
                <div class="catgry-box" style="cursor:pointer;min-height: 250px; background:#fff;color:#EF7F22;">
                    <img src="<?php echo $cat_image; ?>" alt="" width="51px">
                    <!--<a href="<?php echo $this->webroot.'users/coursefilter/'.base64_encode($catid); ?>" >-->
                    <h3><?php echo $category['Category']['category_name']; ?></h3>
                  
                </div>
            
            </div>
            <?php
            endforeach;
             ?>
           
<!--            <div class="col-sm-4">
                <div class="catgry-box">
                    <img src="<?php //echo $this->webroot; ?>images/i-2.png" alt="">
                    <h3>It / Computing</h3>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="catgry-box">
                    <img src="<?php //echo $this->webroot; ?>images/i-3.png" alt="">
                    <h3>It / Computing</h3>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="catgry-box">
                    <img src="<?php //echo $this->webroot; ?>images/i-4.png" alt="">
                    <h3>It / Computing</h3>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="catgry-box">
                    <img src="<?php //echo $this->webroot; ?>images/i-5.png" alt="">
                    <h3>It / Computing</h3>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="catgry-box">
                    <img src="<?php //echo $this->webroot; ?>images/i-6.png" alt="">
                    <h3>It / Computing</h3>
                </div>
            </div>-->
            <div class="clearfix"></div>
            <div class="col-md-12">
                <h4 class="text-center"><a href="<?php echo $this->webroot . 'users/courselisting'; ?>" class="btn btn-primary"><?php echo ALL_CATEGORIES; ?></a></h4>
            </div>
        </div>
    </div>
</section>

<section class="why-lad">
    <div class="container">
        <div class="row">
            
            <?php echo $why_ladder['CmsPage']['page_description']; ?>
<!--            <div class="col-md-12">
                <h1><span>Why</span> Ladder.ng</h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/feature-border.png" alt=""></p>
            </div>
            <div class="col-sm-4">
                <div class="why-box">
                    <img src="<?php echo $this->webroot; ?>images/why-1.png" alt="">
                    <h2>Save Money</h2>
                    <p>Save up to 40% on your project</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="why-box">
                    <img src="<?php echo $this->webroot; ?>images/why-2.png" alt="">
                    <h2>Save Time</h2>
                    <p>Only takes 1 minute</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="why-box">
                    <img src="<?php echo $this->webroot; ?>images/why-3.png" alt="">
                    <h2>Receive Multiple Quotes</h2>
                    <p>From trusted local companies</p>
                </div>
            </div>-->
        </div>
    </div>
</section>
<?php //pr($featuredVenues); ?>
<section class="why-lad featr-venue">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span><?php echo FEATURED; ?></span><?php echo ' Providers'; ?></h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/feature-border.png" alt=""></p>
            </div>

            <div class="col-md-12 featured-slider">
                <ul class="bxslider2">
                     <?php
                    if(!empty($user_provider))
                    {
                    
                    foreach($user_provider as $user_provider) :

                        $user_id=$user_provider['User']['id'];


                      /*  if($user_provider['PostImage']['0']['originalpath'] != '') {
                            $featuredVenueImage = $this->webroot . 'img/post_img/'. $featuredVenue['PostImage']['0']['originalpath'];
                        } else {
                            $featuredVenueImage = $this->webroot . 'images/feature-item-1.jpg';
                        } */
                    ?>
                    <li style="cursor:pointer;" onclick="javascript:window.location.href='<?php echo $this->webroot; ?>users/profile/<?php echo base64_encode($user_id) ?>'">
                        <div class="featr-phto" style="margin:0px auto;text-align:center;float:none;">
                            <?php
                        $uploadImgPath = WWW_ROOT.'user_images';    
                        $per_profile_img=isset($user_provider['UserImage']['0']['originalpath'])?$user_provider['UserImage']['0']['originalpath']:'';
                        if($per_profile_img!='' && file_exists($uploadImgPath . '/' . $per_profile_img)){
                            $ImgLink=$this->webroot.'user_images/'.$per_profile_img;
                        }else{
                            $ImgLink=$this->webroot.'user_images/default.png';
                        } 
                        echo '<img src="'.$ImgLink.'" alt="" height="100px" width="100px"/>';
                             ?>
                            
                        </div>
                        <div style="clear:both;"></div>
                       <div style="margin:0px auto;text-align:center;float:none;">
                         <p >                    
                         <a href="" class="btn btn-primary" style="padding: 7px; margin: 16px;"><?php echo 'Got Featured'; ?></a>
                         </p>
                       </div>

                    </li>
                   
                    
                    <?php endforeach; 

                    }
                    else
                    {
                        echo "There is no Featured Providers";
                    }
                     ?>

                    <!--<li>
                        <div class="featr-phto">
                            <img src="<?php echo $this->webroot; ?>images/feature-item-1.jpg" alt="">
                        </div>
                        <aside>
                            <h4 class="title">Lorem ipsum</h4>
                            <p class="descr">Lorem ipsum dolor sit amet, consetetur sed diam nonumy.</p>
                            <p class="location"><span><i class="fa fa-map-marker"></i></span> USA, Los Angels</p>
                        </aside>
                    </li>
                    <li>
                        <div class="featr-phto">
                            <img src="<?php echo $this->webroot; ?>images/feature-item-1.jpg" alt="">
                        </div>
                        <aside>
                            <h4 class="title">Lorem ipsum</h4>
                            <p class="descr">Lorem ipsum dolor sit amet, consetetur sed diam nonumy.</p>
                            <p class="location"><span><i class="fa fa-map-marker"></i></span> USA, Los Angels</p>
                        </aside>
                    </li>
                    <li>
                        <div class="featr-phto">
                            <img src="<?php echo $this->webroot; ?>images/feature-item-1.jpg" alt="">
                        </div>
                        <aside>
                            <h4 class="title">Lorem ipsum</h4>
                            <p class="descr">Lorem ipsum dolor sit amet, consetetur sed diam nonumy.</p>
                            <p class="location"><span><i class="fa fa-map-marker"></i></span> USA, Los Angels</p>
                        </aside>
                    </li>-->
                </ul>
            </div>
            <div class="col-md-12">
                <p class="text-center">
                    <!--<a href="<?php echo $this->webroot; ?>users/user_provider_listing" class="btn btn-default"><?php echo 'List your Venue?';?></a>
                    <a href="" class="btn btn-primary"><?php echo FIND_A_VENUE; ?></a>-->
                </p>
            </div>
        </div>
    </div>
</section>
<?php //pr($skills); ?>
<section class="trending">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span><?php echo TRENDING; ?></span><?php echo ' '.COURSES; ?></h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/trending-border.png" alt=""></p>
            </div>
            <ul class="bxslider11">
            <?php
            foreach ($skills as $skill) :
                if($skill['Skill']['image'] != '') {
                    $skillBackground = 'style="background: rgba(0, 0, 0, 0) url('.$this->webroot . 'skill_image/'. $skill['Skill']['image'].') no-repeat scroll center center;"';
                } else {
                    $skillBackground = '';
                }
            ?>
            <li >
                <div class="trending-box" style="min-height: 353px;">
                    <div class="square-box square-box-1" <?php echo $skillBackground; ?>></div>
                    <h3><?php echo $skill['Skill']['skill_name']; ?></h3>
                    <p>
                        <?php
                        if(strlen(strip_tags($skill['Skill']['skill_desc'])) > 100) {
                            echo substr(strip_tags($skill['Skill']['skill_desc']), 0, 100) . '...';
                        } else {
                            echo strip_tags($skill['Skill']['skill_desc']);
                        }
                        ?>
                    </p>
                </div>
            </li>
            <?php
            endforeach;
            ?>
            </ul>
<!--            <div class="col-md-4 col-sm-4">
                <div class="trending-box">
                    <div class="square-box square-box-2"></div>
                    <h3>Spanish</h3>
                    <p>Lorem Ipsum has been the industry's standard.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="trending-box">
                    <div class="square-box square-box-3"></div>
                    <h3>Dresmaking</h3>
                    <p>Lorem Ipsum has been the industry's standard.</p>
                </div>
            </div>-->
        </div>
    </div>
</section>
<?php //pr($comments); ?>
<section class="why-lad">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span><?php echo LATEST; ?></span><?php echo ' '.REVIEWS; ?></h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/feature-border.png" alt=""></p>
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
<!--                    <li>
                        <div class="latest-review-holding">
                            <div class="main-image">
                                <img src="<?php echo $this->webroot; ?>images/latest-2.jpg" alt="">
                            </div>
                            <aside>
                                <div class="round-image"><img src="<?php echo $this->webroot; ?>images/face.jpg" alt=""> </div>
                                <div class="title">Lorem ipsum dolr</div>
                                <p class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                <p class="descr">Lorem ipsum dolor sit amet, consetetur sed diam nonumy.</p>
                                <div class="name"><i>John Dow</i><br>CEO</div>
                                <p class="text-center"><a href="" class="btn btn-default">Read More</a></p>
                            </aside>
                        </div>
                    </li>
                    <li>
                        <div class="latest-review-holding">
                            <div class="main-image">
                                <img src="<?php echo $this->webroot; ?>images/latest-3.jpg" alt="">
                            </div>
                            <aside>
                                <div class="round-image"><img src="<?php echo $this->webroot; ?>images/face.jpg" alt=""> </div>
                                <div class="title">Lorem ipsum dolr</div>
                                <p class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                <p class="descr">Lorem ipsum dolor sit amet, consetetur sed diam nonumy.</p>
                                <div class="name"><i>John Dow</i><br>CEO</div>
                                <p class="text-center"><a href="" class="btn btn-default">Read More</a></p>
                            </aside>
                        </div>
                    </li>
                    <li>
                        <div class="latest-review-holding">
                            <div class="main-image">
                                <img src="<?php echo $this->webroot; ?>images/latest-1.jpg" alt="">
                            </div>
                            <aside>
                                <div class="round-image"><img src="<?php echo $this->webroot; ?>images/face.jpg" alt=""> </div>
                                <div class="title">Lorem ipsum dolr</div>
                                <p class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                <p class="descr">Lorem ipsum dolor sit amet, consetetur sed diam nonumy.</p>
                                <div class="name"><i>John Dow</i><br>CEO</div>
                                <p class="text-center"><a href="" class="btn btn-default">Read More</a></p>
                            </aside>
                        </div>
                    </li>-->
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
</section>

<section class="why-lad latest-courses">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span><?php echo FEATURED; ?></span> <?php echo VENUES; ?></h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/feature-border.png" alt=""></p>
            </div>
            <div class="clearfix"></div>
            <ul class="bxslider10">
            <?php
            foreach ($featuredVenues as $featuredVenue) {
                
//                if($featuredVenue['PostImage']['0']['originalpath'] != '') {
//                    $background1 = 'style="background: url('. $this->webroot . 'img/post_img/'. $featuredVenue['PostImage']['0']['originalpath'] .'); background-size: 100%;"';
//                } else {
//                    $background1 = 'style="background: url('. $this->webroot . 'images/feature-item-1.jpg); background-size: 100%;"';
//                }
                    
            ?>
            <li class="">
                <div class="lat-course-box">
                    <div class="square-box square-box-1" <?php //echo $background1; ?>></div>
                    <h3><?php echo $featuredVenue['Venue']['venue_name']; ?></h3>
                    <p><?php
                    if(strlen(strip_tags($featuredVenue['Venue']['description'])) > 100) {
                        echo substr(strip_tags($featuredVenue['Venue']['description']), 0, 100) . '...';
                    } else {
                        echo strip_tags($featuredVenue['Venue']['description']);
                    }
                    ?></p>
                </div>
            </li>
            <?php
            }
            ?>
            </ul>
<!--            <div class="col-md-4 col-sm-4">
                <div class="lat-course-box">
                    <div class="square-box square-box-2"></div>
                    <h3>Constraction</h3>
                    <p>Lorem Ipsum has been the industry's standard.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="lat-course-box">
                    <div class="square-box square-box-3"></div>
                    <h3>Constraction</h3>
                    <p>Lorem Ipsum has been the industry's standard.</p>
                </div>
            </div>-->
        </div>
    </div>
</section>

<section class="logo-slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="bxslider4">
                    <?php
                    foreach($partners as $partner) {
                    ?>
                    <li>
                        <div class="comp-logo">
                            <img src="<?php echo $this->webroot . 'partners/'. $partner['Partner']['image']; ?>" alt="">
                        </div>
                    </li>
                    <?php
                    }
                    ?>
<!--                    <li>
                        <div class="comp-logo">
                            <img src="<?php echo $this->webroot; ?>images/lgo-2.jpg" alt="">
                        </div>
                    </li>
                    <li>
                        <div class="comp-logo">
                            <img src="<?php echo $this->webroot; ?>images/lgo-3.jpg" alt="">
                        </div>
                    </li>
                    <li>
                        <div class="comp-logo">
                            <img src="<?php echo $this->webroot; ?>images/lgo-4.jpg" alt="">
                        </div>
                    </li>
                    <li>
                        <div class="comp-logo">
                            <img src="<?php echo $this->webroot; ?>images/lgo-5.jpg" alt="">
                        </div>
                    </li>
                    <li>
                        <div class="comp-logo">
                            <img src="<?php echo $this->webroot; ?>images/lgo-1.jpg" alt="">
                        </div>
                    </li>-->
                </ul>
            </div>
        </div>
    </div>
</section>




