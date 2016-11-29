<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
        <link href="<?php echo($this->webroot)?>adminFiles/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
        <link href="<?php echo($this->webroot)?>adminFiles/js/iCheck/skins/square/square.css" rel="stylesheet">
        <link href="<?php echo($this->webroot)?>adminFiles/js/iCheck/skins/square/red.css" rel="stylesheet">
        <link href="<?php echo($this->webroot)?>adminFiles/js/iCheck/skins/square/blue.css" rel="stylesheet">

        <!--dashboard calendar-->
        <link href="<?php echo($this->webroot)?>adminFiles/css/clndr.css" rel="stylesheet">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo($this->webroot)?>adminFiles/js/morris-chart/morris.css">

        <!--common-->
        <link href="<?php echo($this->webroot)?>css/dashboard.css" rel="stylesheet">
<style>
.home-navigation {
    margin-top: 10px;
}
</style>        

<section class="login_body">

    <div class="container">
        <div class="row">
            <?php echo($this->element('leftpanel'))?>
            <div class="col-md-9">
                       <div class="page-heading">
                             <h3>
                Dashboard
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li class="active"> My Dashboard </li>
            </ul>
            <div class="state-info">
                <!-- <section class="panel">
                    <div class="panel-body">
                        <div class="summary">
                            <span>yearly expense</span>
                            <h3 class="red-txt">$ 45,600</h3>
                        </div>
                        <div id="income" class="chart-bar"></div>
                    </div>
                </section> -->
                <section class="panel">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right home-navigation">
                            <li class="signup">
                                <a href="<?php echo $this->webroot . 'withdrawal_requests/index'; ?>"><?php echo 'Accounting Tool'; ?></a>
                            </li>
                            <li class="signup">
                                <a href="<?php echo $this->webroot . 'users/membership'; ?>"><?php echo 'Be a Featured Provider'; ?></a>
                            </li>
                        </ul>
                    </div>    
                 
                </section>
            </div>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <!--statistics start-->
                    <div class="row state-overview">
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <div class="panel purple">
                                <div class="symbol">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?php echo $total_no_of_course; ?></div>
                                    <div class="title">Total Courses</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <div class="panel red">
                                <div class="symbol">
                                    <i class="fa fa-tags"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?php echo $total_no_of_venue; ?></div>
                                    <div class="title">Total Venues</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row state-overview">
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <div class="panel blue">
                                <div class="symbol">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?php echo $total_course_order; ?></div>
                                    <div class="title"> Total Course Order</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <div class="panel green">
                                <div class="symbol">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?php echo $total_course_view; ?></div>
                                    <div class="title">Total View Courses</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--statistics end-->
                </div>
                <div class="col-md-6">
                    <!--more statistics box start-->
                    <div class="panel deep-purple-box">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-7 col-sm-7 col-xs-7">
                                    <div id="graph-donut" class="revenue-graph"></div>

                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-5">
                                    <ul class="bar-legend">
                                        <li><span class="blue"></span> Open rate</li>
                                        <li><span class="green"></span> Click rate</li>
                                        <li><span class="purple"></span> Share rate</li>
                                        <li><span class="red"></span> Unsubscribed rate</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--more statistics box end-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row revenue-states">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <h4>Monthly revenue report</h4>
                                    <div class="icheck">
                                        <div class="square-red single-row">
                                            <div class="checkbox ">
                                                <input type="checkbox" checked>
                                                <label>Online</label>
                                            </div>
                                        </div>
                                        <div class="square-blue single-row">
                                            <div class="checkbox ">
                                                <input type="checkbox">
                                                <label>Offline </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <ul class="revenue-nav">
                                        <li><a href="#">weekly</a></li>
                                        <li><a href="#">monthly</a></li>
                                        <li class="active"><a href="#">yearly</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="clearfix">
                                        <div id="main-chart-legend" class="pull-right">
                                        </div>
                                    </div>

                                    <div id="main-chart">
                                        <div id="main-chart-container" class="main-chart">
                                        </div>
                                    </div>
                                    <ul class="revenue-short-info">
                                        <li>
                                            <h1 class="red">15%</h1>
                                            <p>Server Load</p>
                                        </li>
                                        <li>
                                            <h1 class="purple">30%</h1>
                                            <p>Disk Space</p>
                                        </li>
                                        <li>
                                            <h1 class="green">84%</h1>
                                            <p>Transferred</p>
                                        </li>
                                        <li>
                                            <h1 class="blue">28%</h1>
                                            <p>Temperature</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel">
                        <header class="panel-heading">
                            Top 5 Course
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                             </span>
                        </header>
                        
                        <div class="panel-body">
                            <ul class="goal-progress">
                                <li>
                                    <?php foreach ($top_courses as $post) { ?>
                                    
                                  <!--   <div class="prog-avatar">
                                       <img src="<?php //echo $this->webroot; ?>img/cat_img/<?php //echo $category_detail['CategoryImage']['0']['originalpath']; ?>" alt=""/> 
                                    </div> -->
                                    <div class="details">
                                        <div class="title">
                                            <a href="#"><?php echo $post['Post']['post_title']; ?></a> 
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round(($post['Post']['click_count']/$total_course_view)*100);?>%">
                                                <span class=""><?php echo round(($post['Post']['click_count']/$total_course_view)*100);?>%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </li>
                                <!-- <li>
                                    <div class="prog-avatar">
                                        <img src="images/photos/user2.png" alt=""/>
                                    </div>
                                    <div class="details">
                                        <div class="title">
                                            <a href="#">Cameron Doe</a> - Sales
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 91%">
                                                <span class="">91%</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="prog-avatar">
                                        <img src="images/photos/user3.png" alt=""/>
                                    </div>
                                    <div class="details">
                                        <div class="title">
                                            <a href="#">Hoffman Doe</a> - Support
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="">40%</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="prog-avatar">
                                        <img src="images/photos/user4.png" alt=""/>
                                    </div>
                                    <div class="details">
                                        <div class="title">
                                            <a href="#">Jane Doe</a> - Marketing
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                <span class="">20%</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="prog-avatar">
                                        <img src="images/photos/user5.png" alt=""/>
                                    </div>
                                    <div class="details">
                                        <div class="title">
                                            <a href="#">Hoffman Doe</a> - Support
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                <span class="">45%</span>
                                            </div>
                                        </div>
                                    </div>
                                </li> -->
                            </ul>
                            <!-- <div class="text-center"><a href="#">View all Goals</a></div> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body extra-pad">
                            <h4 class="pros-title">prospective <span>leads</span></h4>
                            <div class="row">
                                <div class="col-sm-4 col-xs-4">
                                    <div id="p-lead-1"></div>
                                    <p class="p-chart-title">Laptop</p>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <div id="p-lead-2"></div>
                                    <p class="p-chart-title">iPhone</p>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <div id="p-lead-3"></div>
                                    <p class="p-chart-title">iPad</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
          <!--       <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body extra-pad">
                            <div class="col-sm-6 col-xs-6">
                                <div class="v-title">Visits</div>
                                <div class="v-value">10,090</div>
                                <div id="visit-1"></div>
                                <div class="v-info">Pages/Visit</div>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <div class="v-title">Unique Visitors</div>
                                <div class="v-value">8,173</div>
                                <div id="visit-2"></div>
                                <div class="v-info">Avg. Visit Duration</div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-md-4">

                    <div class="panel green-box">
                        <div class="panel-body extra-pad">
                            <div class="row">
                                <div class="col-sm-6 col-xs-6">
                                    <div class="knob">
                                        <span class="chart" data-percent="79">
                                            <span class="percent">79% <span class="sm">New Visit</span></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="knob">
                                        <span class="chart" data-percent="56">
                                            <span class="percent">56% <span class="sm">Bounce rate</span></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="calendar-block ">
                                <div class="cal1">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="panel">
                        <header class="panel-heading">
                            Review List
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <ul class="to-do-list" id="sortable-todo">
                                <?php if(!empty($ratings)) { foreach ($ratings as $rating) { ?>
                                <li class="clearfix">
                                    <!-- <span class="drag-marker"> -->
                                    <i></i>
                                    </span>
                                   <!--  <div class="todo-check pull-left">
                                        <input type="checkbox" value="None" id="todo-check"/>
                                        <label for="todo-check"></label>
                                    </div> -->
                                    <p class="todo-title">
                                        <?php //echo $rating['Rating']['comment']; ?>
                                    </p>
                                    <div class="todo-actionlist pull-right clearfix">

                                        <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                    </div>
                                </li>
                                <?php } }else{ echo "None Of your Course is reviewed"; } ?>
                              

                            </ul>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <form role="form" class="form-inline">
                                        <div class="form-group todo-entry">
                                            <input type="text" placeholder="Enter your ToDo List" class="form-control" style="width: 100%">
                                        </div>
                                        <button class="btn btn-primary pull-right" type="submit">+</button>
                                    </form> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- <div class="panel blue-box twt-info">
                        <div class="panel-body">
                            <h3>19 Februay 2014</h3>

                            <p>AdminEx is new model of admin
                            dashboard <a href="#">http://t.co/3laCVziTw4</a>
                            4 days ago by John Doe</p>
                        </div>
                    </div> -->
                    <div class="panel">
                        <!-- <div class="panel-body">
                            <div class="media usr-info">
                                <a href="#" class="pull-left">
                                    <img class="thumb" src="images/photos/user2.png" alt=""/>
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Mila Watson</h4>
                                    <span>Senior UI Designer</span>
                                    <p>I use to design websites and applications for the web.</p>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="panel-footer custom-trq-footer">
                            <ul class="user-states">
                                <li>
                                    <i class="fa fa-heart"></i> 127
                                </li>
                                <li>
                                    <i class="fa fa-eye"></i> 853
                                </li>
                                <li>
                                    <i class="fa fa-user"></i> 311
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
                </div>
            </div>
        </div>
</section>

   <script src="<?php echo($this->webroot)?>adminFiles/js/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="<?php echo($this->webroot)?>adminFiles/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo($this->webroot)?>adminFiles/js/bootstrap.min.js"></script>
        <script src="<?php echo($this->webroot)?>adminFiles/js/modernizr.min.js"></script>
        <script src="<?php echo($this->webroot)?>adminFiles/js/jquery.nicescroll.js"></script>

        <!--easy pie chart-->
        <script src="<?php echo($this->webroot)?>adminFiles/js/easypiechart/jquery.easypiechart.js"></script>
        <script src="<?php echo($this->webroot)?>adminFiles/js/easypiechart/easypiechart-init.js"></script>

        <!--Sparkline Chart-->
        <script src="<?php echo($this->webroot)?>adminFiles/js/sparkline/jquery.sparkline.js"></script>
        <script src="<?php echo($this->webroot)?>adminFiles/js/sparkline/sparkline-init.js"></script>

        <!--icheck -->
        <script src="<?php echo($this->webroot)?>adminFiles/js/iCheck/jquery.icheck.js"></script>
        <script src="<?php echo($this->webroot)?>adminFiles/js/icheck-init.js"></script>

        <!-- jQuery Flot Chart-->
        <script src="<?php echo($this->webroot)?>adminFiles/js/flot-chart/jquery.flot.js"></script>
        <script src="<?php echo($this->webroot)?>adminFiles/js/flot-chart/jquery.flot.tooltip.js"></script>
        <script src="<?php echo($this->webroot)?>adminFiles/js/flot-chart/jquery.flot.resize.js"></script>


        <!--Morris Chart-->
        <script src="<?php echo($this->webroot)?>adminFiles/js/morris-chart/morris.js"></script>
        <script src="<?php echo($this->webroot)?>adminFiles/js/morris-chart/raphael-min.js"></script>

        <!--Calendar-->
        <script src="<?php echo($this->webroot)?>adminFiles/js/calendar/clndr.js"></script>
        <script src="<?php echo($this->webroot)?>adminFiles/js/calendar/evnt.calendar.init.js"></script>
        <script src="<?php echo($this->webroot)?>adminFiles/js/calendar/moment-2.2.1.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>

        <!--common scripts for all pages-->
        <script src="<?php echo($this->webroot)?>adminFiles/js/scripts.js"></script>

        <!--Dashboard Charts-->
        <script src="<?php echo($this->webroot)?>adminFiles/js/dashboard-chart-init.js"></script>

  

    
