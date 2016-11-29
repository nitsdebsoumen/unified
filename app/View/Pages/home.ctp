<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;

App::uses('Debugger', 'Utility');
?>



<div class="home-banner">
    <div class="carousel-caption">
        <h1>Get Boost Up!</h1>
        <p>Your unique marketplace to get connected to wide <br/>network to Industry level solution</p>
        <div class="search_section">
            <form class="form-inline">
                <div class="form-group">
                    <div class="input-group">
                        <select class="form-control" name="">
                            <option>Domestic</option>
                        </select>
                        <div class="input-group-addon"><input type="text" placeholder="Search For Cources"></div>

                        <div class="input-group-addon"><button>Search</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <ul class="bxslider">
        <li><img src="<?php echo $this->webroot; ?>images/banner1.jpg" alt="" /></li>
        <li><img src="<?php echo $this->webroot; ?>images/banner2.jpg" alt="" /></li>
    </ul>
</div>

<section class="our-stat">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span>Our</span> Statistics</h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/stat-border.png" alt=""></p>
            </div>
            <div class="col-sm-4 text-center">
                <div class="stat-box">
                    <img src="<?php echo $this->webroot; ?>images/stat-1.png" alt="">
                    <h1>20k</h1>
                    <p>Available Courses</p>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="stat-box">
                    <img src="<?php echo $this->webroot; ?>images/stat-2.png" alt="">
                    <h1>11M</h1>
                    <p>Total Providers</p>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="stat-box">
                    <img src="<?php echo $this->webroot; ?>images/stat-2.png" alt="">
                    <h1>190</h1>
                    <p>Courses Booked</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="how_it_works" style="background:url(images/how-it-bg.jpg);background-repeat: no-repeat; background-position: top center; background-size: cover">
    <div class="container">
        <div class="row">
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
        </div>
    </div>
</section>

<section class="featured">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span>Featured</span> courses</h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/feature-border.png" alt=""></p>
            </div>
            <div class="col-sm-4">
                <div class="featured-box">
                    <div class="square-box square-box-1"></div>
                    <h3>Photoshop</h3>
                    <p>Lorem Ipsum has been the industry's standard.</p>
                </div>
            </div>
            <div class="col-sm-4">
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
            </div>
        </div>
    </div>
</section>

<section class="catgry">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span>Categories</span></h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/catgry-border.png" alt=""></p>
            </div>
            <div class="col-sm-4">
                <div class="catgry-box">
                    <img src="<?php echo $this->webroot; ?>images/i-1.png" alt="">
                    <h3>It / Computing</h3>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="catgry-box">
                    <img src="<?php echo $this->webroot; ?>images/i-2.png" alt="">
                    <h3>It / Computing</h3>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="catgry-box">
                    <img src="<?php echo $this->webroot; ?>images/i-3.png" alt="">
                    <h3>It / Computing</h3>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="catgry-box">
                    <img src="<?php echo $this->webroot; ?>images/i-4.png" alt="">
                    <h3>It / Computing</h3>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="catgry-box">
                    <img src="<?php echo $this->webroot; ?>images/i-5.png" alt="">
                    <h3>It / Computing</h3>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="catgry-box">
                    <img src="<?php echo $this->webroot; ?>images/i-6.png" alt="">
                    <h3>It / Computing</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <h4 class="text-center"><a href="" class="btn btn-primary">All Categories</a></h4>
            </div>
        </div>
    </div>
</section>

<section class="why-lad">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
            </div>
        </div>
    </div>
</section>

<section class="why-lad featr-venue">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span>Featured</span> Venues</h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/feature-border.png" alt=""></p>
            </div>
            <div class="col-md-12 featured-slider">
                <ul class="bxslider2">
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
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <p class="text-center">
                    <a href="" class="btn btn-default">List a Venue</a>
                    <a href="" class="btn btn-primary">Find a Venue</a>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="trending">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span>Trending</span> Courses Skills</h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/trending-border.png" alt=""></p>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="trending-box">
                    <div class="square-box square-box-1"></div>
                    <h3>Photography</h3>
                    <p>Lorem Ipsum has been the industry's standard.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
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
            </div>
        </div>
    </div>
</section>

<section class="why-lad">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span>Latest</span> Reviews</h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/feature-border.png" alt=""></p>
            </div>
            <div class="col-md-12 latest-revw-slider">
                <ul class="bxslider3">
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
                    </li>
                    <li>
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
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <p class="text-center">
                    <a href="" class="btn btn-default">List a Venue</a>
                    <a href="" class="btn btn-primary">Find a Venue</a>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="why-lad latest-courses">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span>Latest</span> Courses</h1>
                <p class="double-border"><img src="<?php echo $this->webroot; ?>images/feature-border.png" alt=""></p>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4 col-sm-4">
                <div class="lat-course-box">
                    <div class="square-box square-box-1"></div>
                    <h3>Constraction</h3>
                    <p>Lorem Ipsum has been the industry's standard.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
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
            </div>
        </div>
    </div>
</section>

<section class="logo-slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="bxslider4">
                    <li>
                        <div class="comp-logo">
                            <img src="<?php echo $this->webroot; ?>images/lgo-1.jpg" alt="">
                        </div>
                    </li>
                    <li>
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
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="N-letter">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span>Newsletter</span></h1>
                <p class="double-border"><img alt="" src="<?php echo $this->webroot; ?>images/n-lat-border.png"></p>
                <p class="text-center" style="color: #fff; margin-bottom: 20px">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor </p>
            </div>
            <div class="col-md-8 middle-div">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter Your Email">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Submit</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>