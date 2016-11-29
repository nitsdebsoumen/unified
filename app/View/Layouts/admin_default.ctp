<?php
//pr($sitesetting); exit;
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
$cakeDescription = __d('cake_dev', $sitesetting['Setting']['site_name'] . ' Admin Panel');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php //echo $cakeDescription  ?>:
            <?php //echo $title_for_layout; ?>
            <?php echo $sitesetting['Setting']['site_name'] . ' Admin'; ?>
        </title>

        <?php
        //echo $this->Html->meta('icon');		
        if ($this->params['controller'] == 'users' && ($this->params['action'] == 'admin_index' || $this->params['action'] == 'admin_fotgot_password')) {
            echo $this->Html->css('adminstyle');
        } else {
            ?>
        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
            <link href="<?php echo($this->webroot) ?>adminFiles/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
            <link href="<?php echo($this->webroot) ?>adminFiles/js/iCheck/skins/square/square.css" rel="stylesheet">
            <link href="<?php echo($this->webroot) ?>adminFiles/js/iCheck/skins/square/red.css" rel="stylesheet">
            <link href="<?php echo($this->webroot) ?>adminFiles/js/iCheck/skins/square/blue.css" rel="stylesheet">

            <!--dashboard calendar-->
            <link href="<?php echo($this->webroot) ?>adminFiles/css/clndr.css" rel="stylesheet">

            <!--Morris Chart CSS -->
            <link rel="stylesheet" href="<?php echo($this->webroot) ?>adminFiles/js/morris-chart/morris.css">

            <!--common-->
            <link href="<?php echo($this->webroot) ?>adminFiles/css/style.css" rel="stylesheet">
            <link href="<?php echo($this->webroot) ?>adminFiles/css/style-responsive.css" rel="stylesheet">

            <?php echo $this->Html->css('cake.generic'); ?>

            <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!--[if lt IE 9]>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/html5shiv.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/respond.min.js"></script>
            <![endif]-->  
        <?php } ?>    

        <script src="<?php echo($this->webroot) ?>adminFiles/js/jquery-1.10.2.min.js"></script>  

    </head>
    <?php
    if ($this->params['controller'] == 'users' && ($this->params['action'] == 'admin_index' || $this->params['action'] == 'admin_fotgot_password')) {
        ?>
        <div id="container">
            <div id="content">
                <div style="text-align:center;">
                    <?php echo $this->Session->flash(); ?>
                </div>
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
    <?php } else { ?>
        <body class="sticky-header">

            <section>
                <!-- left side start-->
                <?php echo($this->element('admin_sidebar')) ?>
                <!-- left side end-->

                <!-- main content start-->
                <div class="main-content" >

                    <!-- header section start-->
                    <?php echo($this->element('admin_topbar')) ?>
                    <!-- header section end-->

                    <!-- page heading &body wrapper start-->
                    <div id="container">
                        <div id="content">
                            <div style="text-align:center;">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                            <?php echo $this->fetch('content'); ?>
                        </div>
                    </div>
                    <!-- page heading &body wrapper start-->

                    <!--footer section start-->
                    <footer>
                        <?php echo(date('Y')) ?> &copy; <?php echo $sitesetting['Setting']['site_name'] . ' Admin'; ?>
                    </footer>
                    <!--footer section end-->


                </div>
                <!-- main content end-->
            </section>



            <!-- Placed js at the end of the document so the pages load faster -->
            <script src="<?php echo($this->webroot) ?>adminFiles/js/jquery-ui-1.9.2.custom.min.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/jquery-migrate-1.2.1.min.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/bootstrap.min.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/modernizr.min.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/jquery.nicescroll.js"></script>

            <!--easy pie chart-->
            <script src="<?php echo($this->webroot) ?>adminFiles/js/easypiechart/jquery.easypiechart.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/easypiechart/easypiechart-init.js"></script>

            <!--Sparkline Chart-->
            <script src="<?php echo($this->webroot) ?>adminFiles/js/sparkline/jquery.sparkline.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/sparkline/sparkline-init.js"></script>

            <!--icheck -->
            <script src="<?php echo($this->webroot) ?>adminFiles/js/iCheck/jquery.icheck.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/icheck-init.js"></script>

            <!-- jQuery Flot Chart-->
            <script src="<?php echo($this->webroot) ?>adminFiles/js/flot-chart/jquery.flot.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/flot-chart/jquery.flot.tooltip.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/flot-chart/jquery.flot.resize.js"></script>


            <!--Morris Chart-->
            <script src="<?php echo($this->webroot) ?>adminFiles/js/morris-chart/morris.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/morris-chart/raphael-min.js"></script>

            <!--Calendar-->
            <script src="<?php echo($this->webroot) ?>adminFiles/js/calendar/clndr.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/calendar/evnt.calendar.init.js"></script>
            <script src="<?php echo($this->webroot) ?>adminFiles/js/calendar/moment-2.2.1.js"></script>
            <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>

            <!--common scripts for all pages-->
            <script src="<?php echo($this->webroot) ?>adminFiles/js/scripts.js"></script>

            <!--Dashboard Charts-->
            <script src="<?php echo($this->webroot) ?>adminFiles/js/dashboard-chart-init.js"></script>

            <script>
                $(document).ready(function () {
                    // setTimeout(function () {
                    //     $('.message').fadeOut('slow');
                    // }, 2000);
                    // setTimeout(function () {
                    //     $('.success').fadeOut('slow');
                    // }, 2000);
                });
            </script>
        <?php } ?>
        <?php //echo $this->element('sql_dump');  ?>
    </body>
</html>
