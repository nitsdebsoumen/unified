<?php
//pr($userpopdetails);
//echo $userpopdetails['UserImage'][0]['originalpath'];
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$userid = $this->Session->read('user_id');
$cakeDescription = __d('cake_dev', 'Niwi');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?> - <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        #echo $this->Html->css('cake.generic');
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('bootstrap-theme');

        echo $this->Html->script('jquery.min');
        echo $this->Html->script('bootstrap.min');
        ?>
        <link href="<?php echo $this->webroot; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->webroot; ?>/css/jquery.bxslider.css" rel="stylesheet" type="text/css">
        <!-- Custom Fonts -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script>
            $(document).ready(function () {
                $('#list').on('click', function () {
                    $('.product-list').removeClass('grid').addClass('list');
                });
                $('#grid').on('click', function () {
                    $('.product-list').removeClass('list').addClass('grid');
                });
            });
        </script>

        <meta name="og:type" content="website" />
        <meta name="og:image" content=""/>
        <meta name="og:title" content="" />
        <meta name="og:description" content="" />
        <meta name="og:url" content=""/>
        <meta name="og:like" content=""/>

        <meta name="description" content=""/>
        <meta name="title" content=""/>
        <meta name="keywords" content=""/>
        <!--<script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          ga('create', 'UA-75089528-1', 'auto');
          ga('send', 'pageview');
        </script>-->
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-75780072-1', 'auto');
            ga('send', 'pageview');
        </script>

        <style>
            input[type='file'] { color: transparent; }
            .preview{width:200px;border:solid 1px #dedede;padding:10px;}
           #preview{color:#cc0000;font-size:12px}
        </style>

    </head>
    <body>
        <div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog log-holder">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Log In</h4>
                        <h4 style="text-align: center;color: #c1c1c6;" id="postWithoutLogin"></h4>
                        <h4 class="modal-title-info">Login or Create a new account to keep exploring</h4>
                    </div>
                    <div class="modal-body">
                        <form name="loginuser" method="post" action="<?php echo $this->webroot; ?>users/userlogin">
                            <div class="form-group">
                                <button type="button" class="paypal-btn">
                                    <img src="<?php echo $this->webroot; ?>/images/paypal.png" alt="">
                                </button>
                            </div>
                            <div class="form-group">
                                <button type="button" class="Facebook-btn">
                                    <img src="<?php echo $this->webroot; ?>/images/facebook.png" alt="">
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <button type="button" class="google-btn">
                                            <img src="<?php echo $this->webroot; ?>/images/google-plus.png" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <button type="button" class="twitter-btn">
                                            <img src="<?php echo $this->webroot; ?>/images/twitter.png" alt="">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="or"><h4>Or</h4></div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <input type="email" name="data[User][email]" id="email" class="form-control" placeholder="Email Adress" required="required"/>
                            </div>
                            <div class="form-group">
                                <input type="password" name="data[User][password]" id="password" class="form-control" placeholder="Password" required="required"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Log In" class="btn btn-primary btn-block"/>
                            </div>
                            <p class="sign-now">“New to NIWI? <a href="javascript:void(0)" id="signupclose">Sign up now</a> </p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <p class="intrst">Interested in Selling? <a href="javascript:void(0)">Get started now!</a></p>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.Login modal -->
        <div class="modal fade" id="Register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog log-holder">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Join Niwi</h4>
                        <h4 class="modal-title-info">Niwi is the place to discover and buy amazing things</h4>
                    </div>
                    <div class="modal-body">
                        <form name="userregister" method="post" action="<?php echo $this->webroot; ?>users/userregister">
                            <div class="form-group">
                                <button type="button" class="paypal-btn">
                                    <img src="<?php echo $this->webroot; ?>/images/paypal.png" alt="">
                                </button>
                            </div>
                            <div class="form-group">
                                <button type="button" class="Facebook-btn">
                                    <img src="<?php echo $this->webroot; ?>/images/facebook.png" alt="">
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <button type="button" class="google-btn">
                                            <img src="<?php echo $this->webroot; ?>/images/google-plus.png" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <button type="button" class="twitter-btn">
                                            <img src="<?php echo $this->webroot; ?>/images/twitter.png" alt="">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="or"><h4>Or</h4></div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <input type="email" name="data[User][email_address]" id="email" class="form-control" placeholder="Email Adress" required="required"/>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" name="data[User][user_pass]" class="form-control" placeholder="Password" required="required"/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="data[User][fullname]" id="fullname" class="form-control" placeholder="Full Name" required="required"/>
                            </div>
                            <div class="form-group">
<!--							<p class="text-center"><img src="<?php echo $this->webroot; ?>/images/robot.png" class="img-responsive" style="display: inline-block"></p>-->
                                <div class="g-recaptcha" data-sitekey="6LeZYSETAAAAAM_sOQCjc8ghDWmBtuhLBu490WeB"></div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Join Now!" class="btn btn-primary btn-block"/>
                            </div>
                            <p class="sign-now">By signing up, you agree to our <a href="">terms of use</a>, <a href="">privacy policy</a>,and <a href="">cookie policy</a></p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <p class="intrst">Interested in Selling? <a href="">Get started now!</a></p>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.Register modal -->

        <!--########  ADD POST MODAL ######### -->
        <div class="modal fade" id="AddPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog log-holder ad-post-step-holder">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Step <span id="stepNo">1</span></h4>
                        <h4 class="modal-title-info">3 easy steps to post on Niwi</h4>
                    </div>
                    <ul class="nav nav-tabs step-tab" role="tablist">
                        <li role="presentation" id="pli1" class="active"><a aria-controls="PostDtail" role="tab" data-toggle="tab">Post Details</a></li>
                        <li role="presentation" id="pli2"><a aria-controls="AdPhto" role="tab" data-toggle="tab">Add a Photo</a></li>
                        <li role="presentation" id="pli3"><a aria-controls="ConFrm" role="tab" data-toggle="tab">Confirm</a></li>
                    </ul>
                    <div class="modal-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" id="pdiv1" class="tab-pane fade in active" id="PostDtail">
                                <form>
                                    <div class="row">
                                        <div class="col-sm-8 middle-div">
                                            <div class="form-group">
                                                <!--<select class="form-control">
                                                    <option>Select a Category (Required)</option>
                                                </select>-->
                                                <?php  echo $this->Form->input('category_id',array('id'=> 'category_id', 'label'=>false,'required'=>'required','class'=>'form-control','options'=>$catg,'empty'=>'--Select a Category (Required)--')); ?>
                                            </div>


                                            <div class="form-group">
                                                <!--<input type="text" class="form-control" placeholder="Title Description (Required)">-->
                                                <?php echo $this->Form->input('post_title',array('id'=> 'post_title', 'required'=>'required','placeholder'=>'Title Description (Required)','class'=>'form-control','label'=>false)); ?>
                                            </div>
                                            <div class="form-group">
                                                <!--<input type="text" class="form-control" placeholder="Location">-->
                                                <?php echo $this->Form->input('location',array('id'=> 'location', 'required'=>'required','placeholder'=>'Location','class'=>'form-control','label'=>false)); ?>
                                            </div>
                                            <div class="form-group">
                                                <!--<textarea rows="4" class="form-control" style="height: auto" placeholder="Product Description"></textarea>-->
                                                <?php echo $this->Form->input('post_description', array('id'=> 'post_description', 'type' => 'textarea', 'style' => 'height: auto' ,'label'=>false, 'class'=>'form-control', 'placeholder'=>'Product Description',));?>
                                                <small class="grey-text">150 characters max</small>
                                            </div>
                                        </div>
                                    </div>
                                    <script> //var elem = $("#chars"); $("#pdesc").limiter(90, elem); </script>
                                </form>
                            </div>
                            <div role="tabpanel" id="pdiv2" class="tab-pane" id="AdPhto">
                                <input type="hidden" name="postId" id="postId" value="" >
                                <div class="photo-adding-area">
                                <style>
                                    .preview{width:200px;border:solid 1px #dedede;padding:10px;}
                                    #preview{color:#cc0000;font-size:12px}
                                </style>
                                    <ul class="phto-add">

                                        <form id="imageform1" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximage/'>
                                        <li>
                                            <div id="preview1"><img src="<?php echo $this->webroot; ?>images/add-photo2.svg" height="100px" width="100px" alt=""></div>
                                            <p><input type="file" name="photoimg1" id="photoimg1" /></p>
                                        </li>
                                        </form>


                                        <form id="imageform2" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximage/'>
                                        <li>
                                            <div id="preview2"><img src="<?php echo $this->webroot; ?>images/add-photo2.svg" height="100px" width="100px" alt=""></div>
                                            <p><input type="file" name="photoimg2" id="photoimg2" /></p>
                                        </li>
                                        </form>


                                        <form id="imageform3" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximage/'>
                                        <li>
                                            <div id="preview3"><img src="<?php echo $this->webroot; ?>images/add-photo2.svg" height="100px" width="100px" alt=""></div>
                                            <p><input type="file" name="photoimg3" id="photoimg3" /></p>
                                        </li>
                                        </form>


                                        <form id="imageform4" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximage/'>
                                        <li>
                                            <div id="preview4"><img src="<?php echo $this->webroot; ?>images/add-photo2.svg" height="100px" width="100px" alt=""></div>
                                            <p><input type="file" name="photoimg4" id="photoimg4" /></p>
                                        </li>
                                        </form>


                                        <form id="imageform5" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximage/'>
                                        <li>
                                            <div id="preview5"><img src="<?php echo $this->webroot; ?>images/add-photo2.svg" height="100px" width="100px" alt=""></div>
                                            <p><input type="file" name="photoimg5" id="photoimg5" /></p>
                                        </li>
                                        </form>


                                    </ul>
                                    <div class="clearfix"></div>
                                    <h4>Suggested Images</h4>
                                    <p><img src="<?php echo $this->webroot; ?>images/round-tick.png" alt=""></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div role="tabpanel" id="pdiv3" class="tab-pane" id="ConFrm">
                                <form>
                                    <div class="row">
                                        <div class="col-sm-8 middle-div">
                                            <div class="form-group">
                                                <label>BUDGET</label>
                                                <input type="text" name="budget" id="budget" class="form-control" placeholder="$2500">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 50px">
                                                <div class="form-control">
                                                    <div class="radio margin-top0">
                                                        <label>
                                                            <input type="radio" name="price_condition" id="price_condition" value="Fixed"> Fixed
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="price_condition" id="price_condition" value="Negotiable"> Negotiable
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="price_condition" id="price_condition" value="Trade"> Trade
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>PRODUCT CONDITION</label>
                                                <div class="form-control">
                                                    <div class="radio margin-top0">
                                                        <label>
                                                            <input type="radio" name="product_condition" id="product_condition" value="New"> New
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="product_condition" id="product_condition" value="Used"> Used
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="grey-text" style="display: block; border-top:1px solid #e1e1e1; padding-top: 5px">By clicking 'Submit', you agree to abide by our listing rules and terms of use. You also agree to follow through on your listing regardless of the final bid amount. Users who are in violation of these terms may be suspended.</small>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-bordered" data-dismiss="modal" style="padding-right: 20px; padding-left:20px">Skip</button>
                        <span id="postContinue"><button type="button" onclick="savePost('post1')" class="btn btn-primary">Continue</button></span>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.Post modal -->
        <!--########  ADD POST MODAL ######### -->

        <!--########  Edit POST MODAL ######### -->
        <div class="modal fade" id="EditPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog log-holder ad-post-step-holder">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Post Step <span id="estepNo">1</span></h4>
                        <h4 class="modal-title-info">3 easy steps to post on Niwi</h4>
                    </div>
                    <ul class="nav nav-tabs step-tab" role="tablist">
                        <li id="epli1" role="presentation" class="active"><a href="#PostDtail" onclick="pDtail();" aria-controls="PostDtail" role="tab" data-toggle="tab">Post Details</a></li>
                        <li id="epli2" role="presentation"><a href="#AdPhto" onclick="imgDtail();" aria-controls="AdPhto" role="tab" data-toggle="tab">Add a Photo</a></li>
                        <li id="epli3" role="presentation"><a href="#ConFrm" onclick="budDetail();" aria-controls="ConFrm" role="tab" data-toggle="tab">Confirm</a></li>
                    </ul>
                    <div class="modal-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" id="epdiv1" class="tab-pane fade in active" id="PostDtail">
                                <form>
                                    <div class="row">
                                        <div class="col-sm-8 middle-div">
                                            <input type="hidden" name="epostid100" id="epostid100" value="">
                                            <div class="form-group">
                                                <!--<select class="form-control">
                                                    <option>Select a Category (Required)</option>
                                                </select>-->
                                                <?php  echo $this->Form->input('category_id',array('id'=> 'category_idval', 'label'=>false,'required'=>'required','class'=>'form-control','options'=>$catg,'empty'=>'--Select a Category (Required)--')); ?>
                                            </div>
                                            <div class="form-group">
                                                <!--<input type="text" class="form-control" placeholder="Title Description (Required)">-->
                                                <?php echo $this->Form->input('post_title',array('id'=> 'post_titleval', 'required'=>'required','placeholder'=>'Title Description (Required)','class'=>'form-control','label'=>false)); ?>
                                            </div>
                                            <div class="form-group">
                                                <!--<input type="text" class="form-control" placeholder="Location">-->
                                                <?php echo $this->Form->input('location',array('id'=> 'locationval', 'required'=>'required','placeholder'=>'Location','class'=>'form-control','label'=>false)); ?>
                                            </div>
                                            <div class="form-group">
                                                <!--<textarea rows="4" class="form-control" style="height: auto" placeholder="Product Description"></textarea>-->
                                                <?php echo $this->Form->input('post_description', array('id'=> 'post_descriptionval', 'type' => 'textarea', 'style' => 'height: auto' ,'label'=>false, 'class'=>'form-control', 'placeholder'=>'Product Description','maxlength'=>'150'));?> 
                                                <small class="grey-text">150 characters max</small>
                                            </div>
                                        </div>
                                    </div>
                                    <script> //var elem = $("#chars"); $("#pdesc").limiter(90, elem); </script>
                                </form>
                            </div>
                            <div role="tabpanel" id="epdiv2" class="tab-pane" id="AdPhto">
                                <div class="photo-adding-area">
                                    <input type="hidden" name="epostId" id="epostIds" value="" >
                                    <ul class="phto-add">
										
										<form id="existimg">
											
										</form>
                                        <form id="eimageform1" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximageedit/'>
                                        <li>
                                            <div id="epreview1"><img src="<?php echo $this->webroot; ?>images/add-photo2.jpg" height="100px" width="100px" alt=""></div>
                                            <p><input type="file" name="ephotoimg1" id="ephotoimg1" /></p>
                                        </li>
                                        </form>


                                        <form id="eimageform2" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximageedit/'>
                                        <li>
                                            <div id="epreview2"><img src="<?php echo $this->webroot; ?>images/add-photo2.jpg" height="100px" width="100px" alt=""></div>
                                            <p><input type="file" name="ephotoimg2" id="ephotoimg2" /></p>
                                        </li>
                                        </form>


                                        <form id="eimageform3" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximageedit/'>
                                        <li>
                                            <div id="epreview3"><img src="<?php echo $this->webroot; ?>images/add-photo2.jpg" height="100px" width="100px" alt=""></div>
                                            <p><input type="file" name="ephotoimg3" id="ephotoimg3" /></p>
                                        </li>
                                        </form>


                                        <form id="eimageform4" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximageedit/'>
                                        <li>
                                            <div id="epreview4"><img src="<?php echo $this->webroot; ?>images/add-photo2.jpg" height="100px" width="100px" alt=""></div>
                                            <p><input type="file" name="ephotoimg4" id="ephotoimg4" /></p>
                                        </li>
                                        </form>


                                        <form id="eimageform5" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximageedit/'>
                                        <li>
                                            <div id="epreview5"><img src="<?php echo $this->webroot; ?>images/add-photo2.jpg" height="100px" width="100px" alt=""></div>
                                            <p><input type="file" name="ephotoimg5" id="ephotoimg5" /></p>
                                        </li>
                                        </form>


                                    </ul>
                                    <div class="clearfix"></div>
                                    <h4>Suggested Images</h4>
                                    <p><img src="images/round-tick.png" alt=""></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div role="tabpanel" id="epdiv3" class="tab-pane" id="ConFrm">
                                <form>
                                    <div class="row">
                                        <div class="col-sm-8 middle-div">
                                            <div class="form-group">
                                                <label>BUDGET</label>
                                                <input type="text" name="budget" id="budgetval" class="form-control" placeholder="$2500">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 50px">
                                                <div class="form-control">
                                                    <div class="radio margin-top0">
                                                        <label>
                                                            <input type="radio" name="price_conditionval" id="price_conditionval" value="Fixed"> Fixed
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="price_conditionval" id="price_conditionval" value="Negotiable"> Negotiable
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="price_conditionval" id="price_conditionval" value="Trade"> Trade
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>PRODUCT CONDITION</label>
                                                <div class="form-control">
                                                    <div class="radio margin-top0">
                                                        <label>
                                                            <input type="radio" name="product_conditionval" id="product_conditionval" value="New"> New
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="product_conditionval" id="product_conditionval" value="Used"> Used
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <small class="grey-text" style="display: block; border-top:1px solid #e1e1e1; padding-top: 5px">By clicking 'Submit', you agree to abide by our listing rules and terms of use. You also agree to follow through on your listing regardless of the final bid amount. Users who are in violation of these terms may be suspended.</small>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-bordered" data-dismiss="modal" style="padding-right: 20px; padding-left:20px">Skip</button>
                        <span id="editpostContinue"><button type="button" onclick="editpostContinue('post1')" class="btn btn-primary">Continue</button></span>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.Post modal -->
        <!--########  Edit POST MODAL ######### -->


        <nav class="navbar navbar-default">
            <?php if ($userid == ''){?>
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $this->webroot; ?>"><img src="<?php echo $this->webroot; ?>/images/logo.svg" alt="" style="width:89px;height:48px"/></a>
                </div>
                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li><button class="btn btn-bordered app-btn get_app"><span>Get the App!</span> <i></i></button></li>
                        <li><button class="btn btn-primary log-btn" data-toggle="modal" data-target="#Login">Login</button></li>
                        <li><button class="btn btn-primary log-btn camera" onclick="setLoginRequest()" >Add a post</button></li>
                        <!--<li><button class="btn btn-primary log-btn" data-toggle="modal" data-target="#AddPost">Add a post <i><img src="<?php echo $this->webroot; ?>/images/camera.png" alt=""></i></button></li>-->
                    </ul>
                </div>
            </div><!-- /.container-->
            <?php } ?>
            <?php if (isset($userid) && $userid != '') {?>
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $this->webroot; ?>"><img src="<?php echo $this->webroot; ?>images/logo.png" alt="" /></a>
                </div>
                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left after-login-navbar">
                        <!--<li><button class="btn btn-primary log-btn" onclick="editPostModalOpen(16)" >Edit Post </button></li>-->
                        <li><button class="btn btn-primary log-btn camera" data-toggle="modal" data-target="#AddPost">Add a post</button></li>
                        <li class="comment_holder"><a href="" class="comment-icon"><i></i></a></li>
                        <li class="noti_holder">
                            <a href="" class="notifi-icon">
                                <i></i>
                             	<span>1</span>
                            </a>
                            <div class="content-tabs" style="display:none;">
	                            <div class="content-tab-tip"></div>
	                            <ul class="sub-account-menu">
	                                <li><h4>Notifications <span>Mute</span></h4></li>
	                                <li>
		                                <ul class="notifiul">
											<li class="new">
												<div class="nitifi_user">
													<img src="http://107.170.152.166/team4/niwi/user_images/57503e607aa70.jpg" alt="" />
												</div>
												<aside>
													<p><span>Diego Sabogal has</span> the product you are looking <span>for “Macbook Pro 17”</span> on Saturday.</p>
													<span><b class="sky">In Search of</b> Just now</span>
												</aside>
												<div class="nitifi_img">
													<img src="http://107.170.152.166/team4/niwi//img/post_img/574d942879185.jpg" alt="" />
												</div>
											</li>
											<li>
												<div class="nitifi_user">
													<img src="http://107.170.152.166/team4/niwi/user_images/57503e607aa70.jpg" alt="" />
												</div>
												<aside>
													<p><span>Diego Sabogal has</span> the product you are looking <span>for “Macbook Pro 17”</span> on Saturday.</p>
													<span><b class="pink">MarketPlace</b> 15 hours ago</span>
												</aside>
												<div class="nitifi_img">
													<img src="http://107.170.152.166/team4/niwi//img/post_img/574d942879185.jpg" alt="" />
												</div>
											</li>
											<li>
												<div class="nitifi_user">
													<img src="http://107.170.152.166/team4/niwi/user_images/57503e607aa70.jpg" alt="" />
												</div>
												<aside>
													<p><span>Diego Sabogal has</span> the product you are looking <span>for “Macbook Pro 17”</span> on Saturday.</p>
													<span><i class="fa fa-heart"></i> 18 hours ago</span>
												</aside>
												<div class="nitifi_img">
													<img src="http://107.170.152.166/team4/niwi//img/post_img/574d942879185.jpg" alt="" />
												</div>
											</li>
										</ul>
									<li>
	                                <li class="seemore"><a href="">See all</a></li>
	                            </ul>
	                        </div>
                        </li>
                    </ul>
                    <div class="user-sec" >
                        <a href="" class="main-user" >
                            <div class="round-image"><?php if ($userpopdetails['UserImage'][0]['originalpath'] != '') { ?><img src="<?php echo $this->webroot; ?>user_images/<?php echo $userpopdetails['UserImage'][0]['originalpath']; ?>" alt=""><?php } else { ?><img src="<?php echo $this->webroot; ?>user_images/default.png" alt=""><?php } ?></div>
                            <span><?php echo ucwords($userpopdetails['User']['first_name']); ?></span>
                        </a>
                        <div class="content-tab" style="display:none;">
                            <div class="content-tab-tip"></div>
                            <ul class="sub-account-menu">
                                <li><h4><?php echo ucwords($userpopdetails['User']['first_name'] . ' ' . $userpopdetails['User']['last_name']); ?></h4></li>
                                <li>
                                    <div class="user-detill">
                                        <div class="left-side"><?php if ($userpopdetails['UserImage'][0]['originalpath'] != '') { ?><img src="<?php echo $this->webroot; ?>user_images/<?php echo $userpopdetails['UserImage'][0]['originalpath']; ?>" alt=""><?php } else { ?><img src="<?php echo $this->webroot; ?>user_images/default.png" alt=""><?php } ?></div>
                                        <div class="right-side">
                                            <b><?php echo ucwords($userpopdetails['User']['first_name'] . ' ' . $userpopdetails['User']['last_name']); ?></b>
                                            <p class="grey-user"><i class=""><img src="<?php echo $this->webroot; ?>images/grey-location.png" alt=""></i><?php if ($userpopdetails['User']['status'] == 1) { ?>Verified User<?php } ?></p>
                                            <a href="<?php echo $this->webroot; ?>users/edit_profile" class="btn btn-primary">View My Profile</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="menu_dash"><a href="<?php echo $this->webroot;?>users/dashboard">Dashboard</a></li>
                                <li class="menu_dash"><a href="">Invite Friends</a></li>
                                <li class="menu_dash"><a href="">Verify Your Account</a></li>
                                <li class="menu_dash"><a href="">MarketPlace</a></li>
                                <li class="menu_dash"><a href="">History</a></li>
                                <li class="menu_dash"><a href="">Settings</a></li>
                                <li class="menu_dash"><a href="<?php echo $this->webroot; ?>users/userlogout">Log Out</a></li>
                                <li class="seemore"><a href="">See more options</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-->
            <?php } ?>
        </nav>
        <?php if($this->params['action']!='edit_profile' && $this->params['action']!='post_listing' && $this->params['action']!='list_post' && $this->params['action']!='dashboard' && $this->params['action']!='post_details' && $this->params['action']!='favorites' && $this->params['action']!='offer_details')
{ ?>
        <section class="banner">
            <div class="container">
                <h1>You need it?  Find it here!</h1>
                <form name="searchfrm" method="post" action="<?php echo $this->webroot;?>">

                <div class="search-holder">
                    <div class="left-holder">
                        <div class="part1">
                            <input type="text" name="data[title]" placeholder="Search"/>
                        </div>
                        <div class="part2">
                            <input type="text" name="data[location]" placeholder="Location"/>
                        </div>
                    </div>
                    <button class="btn btn-primary" name="search_submit" type="submit">Go</button>
                </div>
            </form>
                <div class="clearfix"></div>
                <div class="mouse-icon"></div>
            </div>
        </section>
        <?php } ?>
         <?php  if($this->params['action']!='dashboard' && $this->params['action']!='favorites' && $this->params['action']!='post_details' && $this->params['action']!='offer_details')
        {

                if($this->params['action']=='edit_profile' ||  $this->params['action']=='post_listing' || $this->params['action']=='list_post')
                { ?>
            <section class="home-wrapper" style="margin-top: 0px;">
        <?php } else { ?>
                <section class="home-wrapper">
        <?php } ?>
                <div class="container">
                    <div class="row">
                        <?php
            }
                ?>
                    <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </section>
            <footer>
                <div class="footer_top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="footer_logo">
                                    <img src="<?php echo $this->webroot; ?>/images/logo-bw.svg" alt="" class="img-responsive" style="width:93px;height:50px">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="footer-links">
                                    <li><a href="">About Niwi</a></li>
                                    <li><a href="">Blog</a></li>
                                    <li><a href="">Mobile App</a></li>
                                    <li><a href="">Help & Contact</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul class="social">
                                    <li><a href="" class="fa fa-facebook-official"></a></li>
                                    <li><a href="" class="fa fa-twitter"></a></li>
                                    <li><a href="" class="fa fa-google-plus-square"></a></li>
                                    <li><a href="" class="fa fa-instagram"></a></li>
                                </ul>
                            </div>
                        </div>
                    <!--<img src="<?php echo $this->webroot; ?>/images/logo_footer.png" alt="" />-->
                    </div>
                </div>
                <div class="footer_middle">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <p>
                                    <span style="padding-right:12px"><img src="<?php echo $this->webroot; ?>/images/app-store.svg" alt="" style="width:131px;height:44px"></span>
                                    <span style="padding-left:12px"><img src="<?php echo $this->webroot; ?>/images/google-play.svg" alt="" style="width:131px;height:44px"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer_bootom">
                    <div class="container">
                        <div class="row">
                            <p class="copyright">© <?php echo date('Y'); ?> Niwi, LLC All Rights reserved. Niwi <a href="">Terms & Conditions,</a>  <a href="">Coockies Policy,</a> and <a href="">Privacy Policy</a></p>
                        </div>
                    </div>
                </div>
            </footer>
            <script src='https://www.google.com/recaptcha/api.js'></script>
            <script>
            $('#signupclose').click(function (e) {
                e.preventDefault();

                $('#Login')
                        .modal('hide')
                        .on('hidden.bs.modal', function (e) {
                            $('#Register').modal('show');

                            $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
                        });

            });
            </script>
            <?php echo $this->Html->script('jquery.form'); ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('.main-user').click(function () {
                        $('.content-tab').slideToggle('fast');
                        return false;
                    });
                    $('.noti_holder').click(function () {
                        $('.content-tabs').slideToggle('fast');
                        return false;
                    });
					
                    $('#ephotoimg1').on('change', function () {
                       $("#epreview1").html('');
                       $("#epreview1").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#eimageform1").ajaxForm({
                           target: '#epreview1'
                       }).submit();
                   });

                    $('#ephotoimg2').on('change', function () {
                       $("#epreview2").html('');
                       $("#epreview2").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#eimageform2").ajaxForm({
                           target: '#epreview2'
                       }).submit();
                   });

                    $('#ephotoimg3').on('change', function () {
                       $("#epreview3").html('');
                       $("#epreview3").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#eimageform3").ajaxForm({
                           target: '#epreview3'
                       }).submit();
                   });

                    $('#ephotoimg4').on('change', function () {
                       $("#epreview4").html('');
                       $("#epreview4").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#eimageform4").ajaxForm({
                           target: '#epreview4'
                       }).submit();
                   });

                    $('#ephotoimg5').on('change', function () {
                       $("#epreview5").html('');
                       $("#epreview5").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#eimageform5").ajaxForm({
                           target: '#epreview5'
                       }).submit();
                   });

                   // #######################################

                    $('#photoimg1').on('change', function () {
                       $("#preview1").html('');
                       $("#preview1").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#imageform1").ajaxForm({
                           target: '#preview1'
                       }).submit();
                   });

                    $('#photoimg2').on('change', function () {
                       $("#preview2").html('');
                       $("#preview2").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#imageform2").ajaxForm({
                           target: '#preview2'
                       }).submit();
                   });

                    $('#photoimg3').on('change', function () {
                       $("#preview3").html('');
                       $("#preview3").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#imageform3").ajaxForm({
                           target: '#preview3'
                       }).submit();
                   });

                    $('#photoimg4').on('change', function () {
                       $("#preview4").html('');
                       $("#preview4").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#imageform4").ajaxForm({
                           target: '#preview4'
                       }).submit();
                   });

                    $('#photoimg5').on('change', function () {
                       $("#preview5").html('');
                       $("#preview5").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#imageform5").ajaxForm({
                           target: '#preview5'
                       }).submit();
                   });

                });
            </script>


            <script type="text/javascript">
                function setLoginRequest(){
                    //alert("Please Login");
                    $("#postWithoutLogin").html("User Must be Loged In To Post");
                    $('#Login').modal('show');
                }

                function pDtail(){
                    var pid = $("#epostid100").val();
                    var post = "'post1'";
                    var btn = '<button type="button" onclick="editpostContinue('+post+')" class="btn btn-primary">Continue</button></span>';;
                    $("#editpostContinue").html(btn);
                    $('#epli1').addClass('active');
                    $('#epli2').removeClass('active');
                    $('#epli3').removeClass('active');
                    $('#epdiv1').addClass('active');
                    $('#epdiv2').removeClass('active');
                    $('#epdiv3').removeClass('active');
                    $("#estepNo").html('1');

                }

                function imgDtail(){
                    var pid = $("#epostid100").val();
                    var post = "'post2'";
                    var btn = '<button type="button" onclick="editpostContinue('+post+')" class="btn btn-primary">Continue</button></span>';;
                    $("#editpostContinue").html(btn);
                    $('#epli2').addClass('active');
                    $('#epli1').removeClass('active');
                    $('#epli3').removeClass('active');
                    $('#epdiv2').addClass('active');
                    $('#epdiv1').removeClass('active');
                    $('#epdiv3').removeClass('active');
                    $("#estepNo").html('2');
                }

                function budDetail(){
                    var pid = $("#epostid100").val();
                    var post = "'post3'";
                    var btn = '<button type="button" onclick="editpostContinue('+post+')" class="btn btn-primary">Continue</button></span>';;
                    $("#editpostContinue").html(btn);
                    $('#epli3').addClass('active');
                    $('#epli1').removeClass('active');
                    $('#epli2').removeClass('active');
                    $('#epdiv3').addClass('active');
                    $('#epdiv1').removeClass('active');
                    $('#epdiv2').removeClass('active');
                    $("#estepNo").html('3');
                }

                function editpostContinue(post){
                    //alert(post);
                    if(post == "post1"){
                        $.ajax({
                            type: "POST",
                            url: "<?php echo $this->Html->url('/'); ?>posts/editoldpost/",
                            //dataType: "json",
                            data: {id               : $("#epostid100").val(),
                                   category_id      : $("#category_idval").val(),
                                   post_title       : $("#post_titleval").val(),
                                   location         : $("#locationval").val(),
                                   post_description : $("#post_descriptionval").val()
                                  }
                        }).done(function(msg) {
                            //alert(msg);
                            if(msg != 0){
                                var post = "'post2'";
                                var btn = '<button type="button" onclick="editpostContinue('+post+')" class="btn btn-primary">Continue</button></span>';;
                                $("#editpostContinue").html(btn);
                                $('#epli2').addClass('active');
                                $('#epli1').removeClass('active');
                                $('#epli3').removeClass('active');
                                $('#epdiv2').addClass('active');
                                $('#epdiv1').removeClass('active');
                                $('#epdiv3').removeClass('active');
                                $("#estepNo").html('2');

                            }
                        });
                    } if(post == "post2"){
                        var pid = $("#epostid100").val();
                        var post = "'post3'";
                        var btn = '<button type="button" onclick="editpostContinue('+post+')" class="btn btn-primary">Continue</button></span>';;
                        $("#editpostContinue").html(btn);
                        $('#epli3').addClass('active');
                        $('#epli1').removeClass('active');
                        $('#epli2').removeClass('active');
                        $('#epdiv3').addClass('active');
                        $('#epdiv1').removeClass('active');
                        $('#epdiv2').removeClass('active');
                        $("#estepNo").html('3');
                    } if(post == "post3"){

                        //alert($("#price_conditionval").val()); alert($("#product_conditionval").val());

                        $.ajax({
                            type: "POST",
                            url: "<?php echo $this->Html->url('/'); ?>posts/editoldpostbudget/",
                            //dataType: "json",
                            data: {id               : $("#epostid100").val(),
                                   budget               : $("#budgetval").val(),
                                   price_condition      : $("#price_conditionval").val(),
                                   product_condition    : $("#product_conditionval").val()
                                  }
                        }).done(function(msg) {
                            //alert(msg)
                            window.location.reload();
                        });
                    }
                }

                function deleteImg(imgid){
                    //alert(imgid);
                        $.ajax({
                            type: "POST",
                            url: "<?php echo $this->Html->url('/'); ?>posts/deletePostImage/",
                            //dataType: "json",
                            data: {id : imgid}
                        }).done(function(msg) {
                            //alert(msg)
                            $('#hide_'+imgid).hide();
                            //window.location.reload();
                        });
                 }


                function editPostModalOpen(pid){
                    //alert(pid);
                    //epostid100
                    $('#epostid100').val(pid);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Html->url('/'); ?>posts/fetchpostdata/",
                        //dataType: "json",
                        data: {pid: pid}
                    }).done(function (msg) {
                        respsText = JSON.parse(msg);
                        //alert(msg['Post']['location']);
                        //alert(respsText.Post.location);
                        //alert(Object.keys(respsText.PostImage).length);

                        $("#category_idval").val(respsText.Post.category_id);
                        $("#post_titleval").val(respsText.Post.post_title);
                        $("#locationval").val(respsText.Post.location);
                        $("#post_descriptionval").val(respsText.Post.post_description);

                        $("#budgetval").val(respsText.Post.price);
                        if(respsText.Post.price_condition == "Fixed"){
                            $('input:radio[name="price_conditionval"]').filter('[value="Fixed"]').attr('checked', true);
                        } else if(respsText.Post.price_condition == "Negotiable"){
                            $('input:radio[name="price_conditionval"]').filter('[value="Negotiable"]').attr('checked', true);
                        } else if(respsText.Post.price_condition == "Trade"){
                            $('input:radio[name="price_conditionval"]').filter('[value="Trade"]').attr('checked', true);
                        }

                        if(respsText.Post.product_condition == "New"){
                            $('input:radio[name="product_conditionval"]').filter('[value="New"]').attr('checked', true);
                        } else if(respsText.Post.product_condition == "Used"){
                            $('input:radio[name="product_conditionval"]').filter('[value="New"]').attr('checked', true);
                        }

                        //var ImgCnt=Object.keys(respsText.PostImage).length;
                        //var pimgcnt = Object.keys(respsText.PostImage).length;
                        var forum = respsText.PostImage;
                        //alert(forum);
                        for (var i = 0; i < forum.length; i++) {
                                // forum.length
                               var object = forum[i];
                               var value = object.resizepath;
                               var pimgid = object.id;
                               $("#existimg").append('<li id="hide_'+pimgid+'"> <i class="fa fa-times" onclick="deleteImg('+pimgid+');"></i><img src="<?php echo $this->webroot;?>img/post_img/'+value+'" alt=""></li>');
                        }
                        $('#epostId').val(pid);
                    });
                    $("#EditPost").modal('show');
                }


                function savePost(post){
                    if(post == "post1"){
                        //alert('++ 1');
                        //alert($("#category_id").val());
			if($("#category_id").val()==""){ alert("Please Choose Category!"); $("#category_id").focus(); return false; }
			if($("#post_title").val()==""){ alert("Please Give Title Description!"); $("#post_title").focus(); return false; }
			if($("#location").val()==""){ alert("Please Give Location!"); $("#location").focus(); return false; }
			if($("#post_description").val()==""){ alert("Please Give Description!"); $("#post_description").focus(); return false; }
                        $.ajax({
                            type: "POST",
                            url: "<?php echo $this->Html->url('/'); ?>posts/addnewpost/",
                            //dataType: "json",
                            data: {category_id      : $("#category_id").val(),
                                   post_title       : $("#post_title").val(),
                                   location         : $("#location").val(),
                                   post_description : $("#post_description").val()
                                  }
                        }).done(function(msg) {
                            //alert(msg);
                            if(msg != 0){
                                $('#postId').val(msg);
                                $('#pli1').removeClass('active');
                                $('#pli2').addClass('active');
                                $('#pdiv1').removeClass('active');
                                $('#pdiv2').addClass('active');
                                $("#stepNo").html(2);

                                var post2 = "'post2'";
                                var btn = '<button type="button" onclick="savePost('+post2+')" class="btn btn-primary">Continue</button></span>';;
                                $("#postContinue").html(btn);
                            }
                        });
                    } if(post == "post2"){
                        $('#pli2').removeClass('active');
                        $('#pli3').addClass('active');
                        $('#pdiv2').removeClass('active');
                        $('#pdiv3').addClass('active');
                        $("#stepNo").html(3);
                        var post3 = "'post3'";
                        var btn = '<button type="button" onclick="savePost('+post3+')" class="btn btn-primary">Continue</button></span>';;
                        $("#postContinue").html(btn);
                    } if(post == "post3"){
                        $.ajax({
                            type: "POST",
                            url: "<?php echo $this->Html->url('/'); ?>posts/addnewpostbudget/",
                            //dataType: "json",
                            data: {budget               : $("#budget").val(),
                                   price_condition      : $("#price_condition").val(),
                                   product_condition    : $("#product_condition").val()
                                  }

                        }).done(function(msg) {
                            //alert(msg);
                            $('#category_id').val('');
                            $('#post_title').val('');
                            $('#location').val('');
                            $('#post_description').val('');
                            $('#postId').val('');
                            $('#budget').val('');
                            $('#price_condition').val('');
                            $('#product_condition').val('');
                            // Reload Window
                            window.location.reload();
                        });
                    }
                }

            </script>
            <script>
			$(".mouse-icon").click(function() {
				$('html,body').animate({
				scrollTop: $(".home-wrapper").offset().top},
				'slow');
			});
			</script>
			<script>

			var didScroll;
			var lastScrollTop = 0;
			var delta = 5;
			var navbarHeight = $('.navbar-default').outerHeight();

			$(window).scroll(function(event){
			    didScroll = true;
			});

			setInterval(function() {
			    if (didScroll) {
			        hasScrolled();
			        didScroll = false;
			    }
			}, 250);

			function hasScrolled() {
			    var st = $(this).scrollTop();
			    
			    // Make sure they scroll more than delta
			    if(Math.abs(lastScrollTop - st) <= delta)
			        return;
			    
			    // If they scrolled down and are past the navbar, add class .nav-up.
			    // This is necessary so you never see what is "behind" the navbar.
			    if (st > lastScrollTop && st > navbarHeight){
			        // Scroll Down
			        
			        $('.navbar-default').removeClass('sticky',1000);
			        
			        //console.log(st);
			        
			    } else {
			        // Scroll Up
			        if(st + $(window).height() < $(document).height()) {
			        	
			            $('.navbar-default').addClass('sticky',1000);
			            if(st < 2)
			            {
							$('.navbar-default').removeClass('sticky',1000);
						}
			        }
			    }
			    
			    lastScrollTop = st;
				}
</script>
<script>
	$(document).ready(function () {
		$("#post_description").keyup(function(){
		  $(".grey-text").text("Characters left: " + (150 - $(this).val().length));
		  
		  var values = parseInt($(this).val().length);		  
		});
	});

</script>

<script>

$(document).ready(function(){
     var d = new Date();
     var n = d.getTimezoneOffset();
     $.ajax({
              url     : "<?php echo $this->webroot;?>/posts/getgmttime",
              type    : "POST",
              cache   : false,
              data    : {offset : n},
              success : function(data){
                      //alert(data);
              //return false;
             
              }
          });
    
    });

</script>
<?php //echo $this->element('sql_dump'); ?>
    </body>
</html>