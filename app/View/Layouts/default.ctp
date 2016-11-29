<?php
//pr($notification);
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
$offset = $this->Session->read('timezone');
$cakeDescription = __d('cake_dev', 'Ladder');


//if(isset($this->Session->read('language')) && $this->Session->read('language')!='Spanish')
//{
//}
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ladder.ng</title>
        <meta name="keywords" content="<?php //echo $MetaTagskeywords; ?>"/>
        <meta name="description" content="<?php //echo $MetaTagsdescripton; ?>"/>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('bootstrap');
        echo $this->Html->css('bootstrap-theme');
        ?>   
        <link href="<?php echo $this->webroot; ?>font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
        <link href="<?php echo $this->webroot; ?>css/jquery.bxslider.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->webroot; ?>css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/intlTelInput.css" />
        <link href="<?php echo $this->webroot; ?>css/fullcalendar.print.css" rel='stylesheet' media='print' />
        <link href="<?php echo $this->webroot; ?>css/fullcalendar.min.css" rel='stylesheet' />
        <link href="<?php echo $this->webroot; ?>css/fullcalendar.print.css" rel='stylesheet' media='print' />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">


        <script src="<?php echo $this->webroot; ?>js/moment.min.js"></script>
        <?php
        echo $this->Html->script('jquery.min');
        ?>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="<?php echo $this->webroot; ?>js/formValidation.js"></script>
        <script src="<?php echo $this->webroot; ?>js/intlTelInput.js"></script>
        <script src="<?php echo $this->webroot; ?>js/jquery.infinitescroll.min.js"></script>
        <script src="<?php echo $this->webroot; ?>js/manual-trigger.js"></script>
        <script src="<?php echo $this->webroot; ?>js/debug.js"></script>
        <script src="<?php echo $this->webroot; ?>js/fullcalendar.min.js"></script>

        <script type="text/javascript" src="//platform.linkedin.com/in.js">
            api_key: 812kjm9gjqu2hs
            kjm9gjqu2hs
            authorize: true
            onLoad: onLinkedInLoad
        </script>
<!--        <script src="<?php echo $this->webroot; ?>js/languages/jquery.validationEngine-en.js"></script>
<script src="<?php echo $this->webroot; ?>js/jquery.validationEngine.js"></script>-->

        <style>
            #flashMessage.message, #flashMessage.success, #flashMessage.error {
                position: absolute;
                text-align: center;
                width: 100%;
                z-index: 99999;
            }
            #loading {
                background-color: #fff;
                display: none;
                height: 100%;
                left: 0;
                opacity: 0.7;
                position: fixed;
                text-align: center;
                top: 0;
                width: 100%;
                z-index: 9999;
            }

            #loading > img {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                margin: auto;
            }
        </style>
    </head>
    <body>
        <div id="loading">
            <img src="<?php echo $this->webroot . 'images/loading.gif' ?>" />
        </div>
        <?php echo $this->Session->flash(); ?>
        <nav class="navbar navbar_before 
        <?php
        if (isset($this->params['action']) && $this->params['action'] == 'login') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'signup') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'forgotpassword') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'resetpassword') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'activate_account') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'editprofile') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'courselisting') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'search') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'coursefilter') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'coursedetail') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'update_profile') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'change_password') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'add_course') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'list_course') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'profile') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'user_provider_listing') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'import_csv') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'venue_add') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'addkyc') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'kyclisting') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'index') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'quantity') {
            echo 'navbar-inner';
        } else if (isset($this->params['action']) && $this->params['action'] == 'cart') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'membership') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'getStatus') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'membership_checkout') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'add') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'view') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'edit') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'csv_upload') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'venue_csv_upload') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'provider_dashboard') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'company_details') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'edit_company_details') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'cms_page') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'venue_page') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'plans') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'featured_paln_order') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'activationlink') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'user_reviews') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'user_enquiries') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'user_dashboard') {
            echo 'navbar-inner';
        }else if  (isset($this->params['action']) && $this->params['action'] == 'accounting') {
            echo 'navbar-inner';
        }
         else {
            echo 'navbar-fixed-top';
        }
        ?> "> 
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $this->webroot; ?>"><img src="<?php echo $ladder_logo; ?>" alt="" /></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right home-navigation">
                        <?php
                        foreach ($headerMenus as $headerMenu) {
                            echo '<li><a href="'.$this->webroot.'users/cms_page/'.$headerMenu['CmsPage']['slug'].'" >' . $headerMenu['CmsPage']['page_title'] . '</a></li>';
                        }
                        ?>

                        <?php
                        $userid = $this->Session->read('userid');
                        if (isset($userid)) {
                            ?> 
                            <li>
                                <a href="<?php echo $this->webroot; ?>users/logout"><?php echo LOGOUT; ?></a>
                            </li>        
                            <?php if($userdetails!='' && $userdetails['User']['admin_type'] == 1 || $userdetails['User']['admin_type'] == 2){?>
                            <li class="signup">
                                <a href="<?php echo $this->webroot . 'users/provider_dashboard'; ?>"><?php echo DASHBOARD; ?></a>
                            </li>
                            <?php }
                            else{ ?>
                            <li class="signup">
                                <a href="<?php echo $this->webroot . 'users/user_dashboard'; ?>"><?php echo DASHBOARD; ?></a>
                            </li>
                            <?php } ?>
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo $this->webroot; ?>users/login"><?php echo LOGIN; ?></a>   
                            </li>        
                            <li class="signup">
                                <a href="<?php echo $this->webroot; ?>users/signup"><?php echo SIGN_UP; ?></a>
                            </li>
                            <?php
                        }
                        ?>
                        <?php if($userdetails!='' && $userdetails['User']['admin_type'] == 2 ){ ?> 
                        <li class="signup">
                                <a href="<?php echo $this->webroot; ?>users/cms_page/sell-courses"><?php echo 'Sell Courses'; ?></a>
                        </li>
                        <?php } ?>
                        <?php if($userdetails!='' && $userdetails['User']['admin_type'] == 1 ){ ?> 
                        <li class="signup">
                                <a href="<?php echo $this->webroot; ?>users/cms_page/sell-venues"><?php echo 'Sell Venues'; ?></a>
                        </li>
                        <?php } ?> 
                    <!--     <li>
                            <a href="javascript:void(0)" onclick="changelan('en')" class="language" style="padding: 6px 10px;">
                                <img src="<?php echo $this->webroot; ?>images/english.png" style="width:24px" />
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="changelan('sp')" class="language" style="display:block; padding: 6px 10px;">
                                <img src="<?php echo $this->webroot; ?>images/spanish.png" style="width:24px" />
                            </a>
                        </li>  -->     
                        <li class="dropdown">
                            <div class="cart-holder" >
                            	<!--<a href="<?php //echo $this->webroot; ?>temp_carts/cart">-->
                                <a href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $this->webroot; ?>images/cart.png" alt=""></a>
                                <p id="cart_quantity"><?php echo isset($product_quantity) ? $product_quantity : '0'; ?></p>
                                    
                               
                                <ul class="dropdown-menu" aria-labelledby="dLabel" id="cart_holder">
                                    <table>
                                    <?php
                                    $count=1;
                                    $st=array(); 
                                    ?> 
                                    <?php if(!empty($mini_cart_details)) {?>   
                                    <?php foreach ($mini_cart_details as $value) { 
                                        if($value['Post']['User']['user_logo']!=''){
                                            $img = $this->webroot.'user_logo/'.$value['Post']['User']['user_logo'];
                                        }
                                        else{
                                            $img = $this->webroot.'images/no_image.png';   
                                        }
                                    ?>
                                	<li>
                                    
                                    <!-- <div class="div-area"> -->
                                        <tr>
                                            <td>
                                        <div class="span-pic">
                                        <img src="<?php echo $img;?>" style="width:25px" />
                                        </div>
                                            </td>
                                            <td>
                                        <div class="span-text">
                                        <a href="#"><?php echo $value['Post']['post_title']; ?></a>
                                        </div>
                                            </td>
                                            <td>
                                        <div class="span-text">
                                            Qty.</br><?php echo $value['TempCart']['quantity'];?>
                                        </div>
                                            </td>
                                            <td>
                                        <div class="span-text">
                                            Price.</br>₦.<?php echo $st[$count]=$value['Post']['price']*$value['TempCart']['quantity']; ?>
                                        </div>
                                            </td>
                                        </tr>    
                                        <div class="clear"></div>
                                    <!-- </div> -->
                                    
                                    </li>
                                    <?php 
                                     $count=$count+1;
                                     } }
                                     ?>
                                   
                                    <!-- <li>
                                    
                                    <div class="div-area">
                                        <div class="span-pic">
                                        <img src="<?php echo $this->webroot; ?>images/bulkimporter-150x150.png" style="width:25px" />
                                        </div>
                                        <div class="span-text">
                                         <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing</a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                   
                                    </li> -->
                                    <li>
                                    <div class="div-area">
                                        <td colspan="3" >
                                    <div class="div-text" style="padding:10px;">
                                        <?php if(isset($userid)) { ?>
                                         <a href="<?php echo $this->webroot; ?>temp_carts/cart">View Cart</a>
                                         <?php  } else{  ?>
                                         <a href="<?php echo $this->webroot; ?>users/login" >Log In</a>
                                         <?php }?>
                                         </div>
                                        </td>
					  <?php
                                            if($count>1){
					    ?>
                                          <td >
                                         <div class="div-text">
                                          <a href="#">
                                          <?php
                                                $total=0; 
                                                foreach($st as $val)
                                                    { 
                                                        $total=$total+$val;
                                                    }
                                                echo 'Grand Total: ₦'.$total;
                                           
                                            ?>
                                          </a>
                                         </div>
                                        </td>  
					<?php
					 }
					 ?>
                                    </div>
                                    </li>
                                  </table>   
                                </ul>
                            </div>
                        </li> 
                             
                    </ul>
                </div><!-- /.navbar-collapse -->

            </div> 
        </nav>

        <?php echo $this->fetch('content'); ?>

        <section class="N-letter">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><span><?php echo NEWSLETTER; ?></span></h1>
                        <p class="double-border"><img alt="" src="<?php echo $this->webroot; ?>images/n-lat-border.png"></p>
                        <p class="text-center" style="color: #fff; margin-bottom: 20px">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor </p>
                    </div>
                    <div class="col-md-8 middle-div">
                        <div class="input-group">
                            <input type="text" class="form-control" id="newsletterInput" placeholder="Enter Your Email" style="color: #fff;" />
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="newsletterSubmit" type="button"><?php echo SUBMIT; ?></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-8">
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="footer-links">
                                    <li><h4><?php echo "ABOUT US"; ?></h4></li>
                                    <?php foreach ($abouts as $key => $about) { ?>
                                    <li><a href="<?php echo $this->webroot.'users/cms_page/'.$about['CmsPage']['slug']; ?>"><span><i class="fa fa-angle-double-right"></i></span><?php echo $about['CmsPage']['page_title']; ?></a></li>
                                    <?php } ?>
                             
                            <li><a href="<?php echo $this->webroot;?>users/contact_us"><span><i class="fa fa-angle-double-right"></i></span> Contact us</a></li>
                            <!--<li><a href="<?php echo $this->webroot;?>users/cms/About Us"><span><i class="fa fa-angle-double-right"></i></span> Support</a></li> -->
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <ul class="footer-links">
                                    <li><h4><?php echo "OUR SERVICES"; ?></h4></li>
                                    <?php foreach ($our_services as $key => $our_service) { ?>
                                    <li><a href="<?php echo $this->webroot.'users/cms_page/'.$our_service['CmsPage']['slug']; ?>"><span><i class="fa fa-angle-double-right"></i></span><?php echo $our_service['CmsPage']['page_title']; ?></a></li>
                                    <?php } ?>
                                    <!-- <li><a href="<?php echo $this->webroot;?>users/cms/About Us"><span><i class="fa fa-angle-double-right"></i></span> For Corporates</a></li>
                                    <li><a href="<?php echo $this->webroot;?>users/cms/About Us"><span><i class="fa fa-angle-double-right"></i></span> For Candidates</a></li> -->
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <ul class="footer-links">
                                    <li><h4><?php echo "OUR TERMS"; ?></h4></li>
                                    <?php foreach ($our_terms as $key => $our_term) { ?>
                                    <li><a href="<?php echo $this->webroot.'users/cms_page/'.$our_term['CmsPage']['slug']; ?>"><span><i class="fa fa-angle-double-right"></i></span><?php echo $our_term['CmsPage']['page_title']; ?></a></li>
                                    <?php } ?>

                                    <!-- <li><a href="<?php echo $this->webroot;?>users/cms/About Us"><span><i class="fa fa-angle-double-right"></i></span> User Terms</a></li>
                                    <li><a href="<?php echo $this->webroot;?>users/cms/About Us"><span><i class="fa fa-angle-double-right"></i></span> Privacy Policy</a></li>
                                    <li><a href="<?php echo $this->webroot;?>users/cms/About Us"><span><i class="fa fa-angle-double-right"></i></span> Cookie Policy</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-4">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="social_icons">
                                    <li><h4><?php echo CONNECT_WITH_US; ?></h4></li>
                                    <li><a href=""><span class="icon"><i class="fa fa-facebook"></i></span> <span class="txt">Facebook</span></a></li>
                                    <li><a href=""><span class="icon"><i class="fa fa-twitter"></i></span> <span class="txt">Twitter</span></a></li>
                                    <li><a href=""><span class="icon"><i class="fa fa-linkedin"></i></span> <span class="txt">Linked in</span></a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="footer-links">
                                    <li><h4><?php echo SECURE_PAYMENT; ?> </h4></li>
                                    <li><img src="<?php echo $this->webroot; ?>images/cashenvoy_logo.png"   alt="" /></li>
                                    <li><img src="<?php echo $this->webroot; ?>images/imgpsh_fullsize1.png" alt="" /></li>
                                    <li><img src="<?php echo $this->webroot; ?>images/imgpsh_fullsize2.png" alt="" /></li>
                                    <li><img src="<?php echo $this->webroot; ?>images/imgpsh_fullsize3.png" alt="" /></li>
                                    <li><img src="<?php echo $this->webroot; ?>images/imgpsh_fullsize4.png" alt="" /></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="link_quick">
                            <!--                        <li><a href="">About US</a></li>
                                                        <li><a href="<?php echo $this->webroot . 'contact_us'; ?>">Contact Us</a></li>
                                                        <li><a href="">List Your Courses</a></li>
                                                        <li><a href="">List Your Venues</a></li>
                                                        <li><a href="">Pricing</a></li>
                                                        <li><a href="">Support</a></li>-->
                            <?php
                            foreach ($footerMenus as $footerMenu) { ?>
                                <li>
                                    <a href="<?php echo $this->webroot;?>users/cms_page/<?php echo $footerMenu['CmsPage']['slug'];?>">
                                        <?php echo $footerMenu['CmsPage']['page_title']; ?>
                                    </a>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">

                    <p class="copyright"><a href=""><?php echo USER_TERMS; ?></a> | <a href=""><?php echo PROVIDER_TERMS; ?></a> | <a href=""><?php echo PRIVACY; ?></a> <a href=""><?php echo COOKIE_POLICY; ?></a> | <a href="">The Live Person Feature</a> &copy; 2016 companyname. All right reserved.</p>
                </div>

            </div>
        </footer>


        <script src="<?php echo $this->webroot; ?>js/jquery.bxslider.js"></script>
        <script>
            (function ($) {
                $('#newsletterSubmit').click(function () {
                    if ($('#newsletterInput').val() == '') {
                        $('#newsletterInput').focus();
                    } else {
                        $.ajax({
                            url: '<?php echo $this->webroot . 'users/newsletterAjax'; ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                email: $('#newsletterInput').val()
                            },
                            success: function (data) {
                                if (data.ack == '0') {
                                    alert(data.msg);
                                } else {
                                    $('#newsletterInput').val('');
                                    alert(data.msg);
                                }
                            }
                        });
                    }
                });
            })(jQuery);
        </script>
        <script>
            $(window).scroll(function () {
                var sticky = $('.navbar-fixed-top'),
                        scroll = $(window).scrollTop();
                if (scroll >= 100) {
                    sticky.css('background', 'rgba(0,0,0,0.9)');
                    sticky.addClass('small-navigation');
                } else {
                    sticky.css('background', 'none');
                    sticky.removeClass('small-navigation');
                }
            });
        </script>

        <script>
            $(document).ready(function () {
                $('.bxslider').bxSlider({
                    auto: true,
                    autoControls: true
                });
                $('.bxslider2').bxSlider({
                    minSlides: 1,
                    maxSlides: 4,
                    slideWidth:250,
                    slideMargin: 20,
                    
                });
                $('.bxslider3').bxSlider({
                    minSlides: 1,
                    maxSlides: 4,
                    slideWidth: 348,
                    slideMargin: 30
                });
                $('.bxslider4').bxSlider({
                    minSlides: 1,
                    maxSlides: 5,
                    slideWidth: 194,
                    slideMargin: 20
                });
                $('.bxslider10').bxSlider({
                    minSlides: 1,
                    maxSlides: 4,
                    slideWidth: 250,
                    slideMargin: 30
                });
                $('.bxslider11').bxSlider({
                    minSlides: 1,
                    maxSlides: 4,
                    slideWidth: 250,
                    slideMargin: 30
                });
                $('.bxslider12').bxSlider({
                    minSlides: 1,
                    maxSlides: 4,
                    slideWidth: 250,
                    slideMargin: 30
                });
                // setTimeout(function () {
                //     $('.message, .success, .error').fadeOut('slow');
                // }, 2000);

            });
        </script>
        <script type="text/javascript">

            function changelan(language) {
                var lang = language;
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->webroot; ?>users/ajaxlang",
                    data: {
                        language: lang
                    },
                    success: function (html) {
                        location.reload();
                    }
                });
            }
        </script>
<script>
  $( function() { $( "#cart_quantity" ).tooltip(); } );
  </script>
 <script>
    $(function(){
        $('#register_as_provider').click(function(){
            window.location.href = '<?php echo $this->webroot .'users/signup/provider'; ?>';
        });
       $('#register_as_student').click(function(){
            window.location.href = '<?php echo $this->webroot .'users/signup/student'; ?>';
        });

    });
</script> 
  <style>
  #cart_details {
    display: inline-block;
    width: 5em;
  }
  </style>

    </body>
</html>

