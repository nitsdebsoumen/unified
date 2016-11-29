<!--<link href="<?php echo $this->webroot;?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo $this->webroot;?>js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="<?php echo $this->webroot;?>css/dashboard.css" rel="stylesheet" type="text/css">
<div class="users form">
<div class="container-fluid">  
            <div class="row-fluid">
               <div class="span12">
                   <div class="hidden-phone" id="theme-change">
                       <i class="icon-cogs"></i>
                        <span class="settings">
                            <span class="text">Theme Color:</span>
                            <span class="colors">
                                <span data-style="default" class="color-default"></span>
                                <span data-style="green" class="color-green"></span>
                                <span data-style="gray" class="color-gray"></span>
                                <span data-style="purple" class="color-purple"></span>
                                <span data-style="red" class="color-red"></span>
                            </span>
                        </span>
                   </div>
                   <h3 class="page-title">
                     Dashboard
                   </h3>
               </div>
            </div>
            <div class="row-fluid">
                <div class="metro-nav">
                    <div class="metro-nav-block nav-block-orange">
                        <a href="#" data-original-title="">
                            <i class="fa fa-user"></i>
                            <div class="info"><?php echo $total_user;?></div>
                            <div class="status">New User</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-yellow">
                        <a href="#" data-original-title="">
                            <i class="icon-tags"></i>
                            <div class="info"><?php echo $total_taskers;?></div>
                            <div class="status">Total Taskers</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-grey">
                        <a href="#" data-original-title="">
                            <i class="fa fa-user"></i>
                            <div class="info"><?php echo $total_task;?></div>
                            <div class="status">Total Task</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-orange">
                        <a href="#" data-original-title="">
                            <i class="fa fa-user"></i>
                            <div class="info"><?php echo $active_user;?></div>
                            <div class="status">Active User</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-orange">
                        <a href="#" data-original-title="">
                            <i class="fa fa-user"></i>
                            <div class="info"><?php echo $inactive_user;?></div>
                            <div class="status">Inactive User</div>
                        </a>
                    </div>
                    
                    
                </div>
             
                <div class="space10"></div>
            </div>
            <div class="row-fluid">

            </div>
            <div class="row-fluid">
                 
                <div class="col-md-12" style=" padding:0px;">
                     <div class="widget red">
                         <div class="widget-title">
                            <h4><i class="icon-comments-alt"></i>  User Activity</h4>
                            <span class="tools">
                                <a class="icon-chevron-down" href="<?php echo $this->webroot.'admin/users/activity_view'; ?>">View All</a>  |  <a class="icon-remove" href="<?php echo $this->webroot.'admin/users/activity_export'; ?>">Export Csv</a>
                            </span>
                         </div>
			<?php foreach($activities as $activity){ 
                            $UserPath = WWW_ROOT . 'user_images';
                            $profile_img = $activity['User']['profile_img'];
                            if(file_exists($UserPath . '/' . $profile_img) && $profile_img!=''){
                                $UserProfImg=$this->webroot.'user_images/'.$profile_img;
                            }else{
                                $UserProfImg=$this->webroot.'user_images/default.png';
                            }
                        ?>
                         <div class="widget-body">
                             <div class="timeline-messages">
                                 <div class="msg-time-chat">
                                     <a href="#" class="message-img"><img class="avatar" src="<?php echo $UserProfImg;?>" alt=""></a>
                                     <div class="message-body msg-in">
                                         <span class="arrow"></span>
                                         <div class="text">
                                             <p class="attribution"><a href="<?php echo $this->webroot;?>admin/users/view/<?php echo $activity['User']['id'] ?>"><b>ID:</b><?php echo $activity['User']['id']?>
                                                     <b>UserName:</b><?php echo $activity['User']['first_name'];?>&nbsp;<?php echo $activity['User']['last_name'];?>,
                                                     <b>Email:</b><?php echo $activity['User']['email'];?>,
                                                     <b>Phone:</b><?php echo $activity['User']['phone_no'];?>,
                                                     <b>Zip:</b><?php echo $activity['User']['zipcode'];?>,
                                                     <b>Last Login IP:</b><?php echo $activity['Activity']['ip'];?>,
                                                     <b>Last Login On:</b><?php echo $activity['Activity']['date'];?>
                                                 
                                                 
                                                 </a></p>
                                         </div>
                                     </div>
                                 </div>
                                 
                             </div>
                             
                         </div>
			<?php } ?>
                     </div>
                 </div>
             </div>
            <div class="row-fluid">
                 
                <div class="col-md-12" style=" padding:0px;">
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-comments-alt"></i>Category</h4>
                             <span class="tools">
                             <a class="icon-chevron-down" href="<?php echo $this->webroot?>admin/categories">View All</a>  |  <a class="icon-remove" href="<?php echo $this->webroot.'admin/categories/export'; ?>">Export Csv</a>
                            </span>
                         </div>
			<?php foreach($categories_list as $category_list)
			{ 
                        $assign_product=count($category_list['Task']);
                        if($assign_product>0)
                        {
                        ?>
                         <div class="widget-body">
                             <div class="timeline-messages">
                                 <div class="">
                                     <div class="message-body msg-in">
                                         <span class="arrow"></span>
                                         <div class="text">
                                             <p class="attribution">
                                            
                                             <b><?php echo $category_list['Category']['name'] ?>(<?php echo $assign_product;?>)</b>
                                                    
                                                 
                                                 
                                                 </a></p>
                                         </div>
                                     </div>
                                 </div>
                                 
                             </div>
                             
                         </div>
                        <?php }} ?>
                         
                     </div>
                 </div>
             </div>      
         </div>
</div>
<style>
#header{padding:0px !important;}    
#header h1{ font-size:12px !important; }    
</style>-->











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
		    <!--<div class="state-info">
		        <section class="panel">
		            <div class="panel-body">
		                <div class="summary">
		                    <span>yearly expense</span>
		                    <h3 class="red-txt">$ 45,600</h3>
		                </div>
		                <div id="income" class="chart-bar"></div>
		            </div>
		        </section>
		        <section class="panel">
		            <div class="panel-body">
		                <div class="summary">
		                    <span>yearly  income</span>
		                    <h3 class="green-txt">$ 45,600</h3>
		                </div>
		                <div id="expense" class="chart-bar"></div>
		            </div>
		        </section>
		    </div> -->
		</div>
		<!-- page heading end-->

		<!--body wrapper start-->
		<div class="wrapper">
		    <div class="row">
		        <div class="col-md-6">
		            <!--statistics start-->
		            <div class="row state-overview">
		                <div class="col-md-6 col-xs-12 col-sm-6">
		                    <div class="panel purple">
		                        <div class="symbol">
		                            <i class="fa fa-gavel"></i>
		                        </div>
		                        <div class="state-value">
		                            <div class="value"><?php echo $total_user;?></div>
                                            <div class="title"><a href="<?php echo $this->webroot?>admin/users/list">Total Users</a></div>
		                        </div>
		                    </div>
		                </div>
		                <div class="col-md-6 col-xs-12 col-sm-6">
		                    <div class="panel red">
		                        <div class="symbol">
		                            <i class="fa fa-tags"></i>
		                        </div>
		                        <div class="state-value">
		                            <div class="value"><?php echo $total_taskers;?></div>
                                            <div class="title"><a href="<?php echo $this->webroot?>admin/users/list">Total Taskers</a></div>
		                        </div>
		                    </div>
		                </div>
                                <div class="col-md-6 col-xs-12 col-sm-6">
		                    <div class="panel green">
		                        <div class="symbol">
		                            <i class="fa fa-users"></i>
		                        </div>
		                        <div class="state-value">
		                            <div class="value"><?php echo $tot_admin_user;?></div>
                                            <div class="title"> <a href="<?php echo $this->webroot?>admin/users/alllist">Admin Users</a></div>
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
		                            <div class="value"><?php echo $total_task;?></div>
                                            <div class="title"> <a href="<?php echo $this->webroot?>admin/tasks/list">Total Tasks</a></div>
		                        </div>
		                    </div>
		                </div>
		                <div class="col-md-6 col-xs-12 col-sm-6">
		                    <div class="panel green">
		                        <div class="symbol">
		                            <i class="fa fa-eye"></i>
		                        </div>
		                        <div class="state-value">
		                            <div class="value"><?php echo $inactive_user;?></div>
                                            <div class="title"> <a href="<?php echo $this->webroot?>admin/users/list">Inactive Users</a></div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <!--statistics end-->
		        </div>
		        <div class="col-md-6">
		            <!--more statistics box start-->
		            <!--<div class="panel deep-purple-box">
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
		            </div>-->
		            <!--more statistics box end-->

				<div class="panel">
		                <header class="panel-heading">
		                    Categories
		                    <span class="tools pull-right">
		                        <a href="javascript:;" class="fa fa-chevron-down"></a>
		                        <a href="javascript:;" class="fa fa-times"></a>
		                     </span>
		                </header>
		                <div class="panel-body">
					<table class="table">
						<thead>
						<tr>
						<th>Name</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($categories_list as $category_list)
						{ 
							$assign_product=count($category_list['Task']);
							if($assign_product>0)
							{
						?>
						<tr>
						<td><?php echo $category_list['Category']['name'] ?>(<?php echo $assign_product;?>)</td>
						</tr>
						<?php } }?>
						</tbody>
					</table>
		                    <div class="text-center"><a href="<?php echo $this->webroot?>admin/categories">View All</a> | <a href="<?php echo $this->webroot.'admin/categories/export'; ?>">Export Csv</a></div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="row">
		        <!--<div class="col-md-8">
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
		        </div> -->
		        <div class="col-md-12">
		            <div class="panel">
		                <header class="panel-heading">
		                    User Activity
		                    <span class="tools pull-right">
		                        <a href="javascript:;" class="fa fa-chevron-down"></a>
		                        <a href="javascript:;" class="fa fa-times"></a>
		                     </span>
		                </header>
		                <div class="panel-body">
					<table class="table">
						<thead>
						<tr>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Zipcode</th>
						<th>Ip</th>
						<th>Date</th>
						</tr>
						</thead>
						<tbody>
						<?php 
                                                $UserCnt=0;
                                                foreach($activities as $activity){ 
                                                    $UserCnt++;
						$UserPath = WWW_ROOT . 'user_images';
						$profile_img = $activity['User']['profile_img'];
						if(file_exists($UserPath . '/' . $profile_img) && $profile_img!=''){
						$UserProfImg=$this->webroot.'user_images/'.$profile_img;
						}else{
						$UserProfImg=$this->webroot.'user_images/default.png';
						}
						?>
						<tr>
						<td><a href="<?php echo $this->webroot;?>admin/users/view/<?php echo $activity['User']['id'] ?>"><?php echo $UserCnt;?></a></td>
						<td><?php echo $activity['User']['first_name'];?>&nbsp;<?php echo $activity['User']['last_name'];?></td>
						<td><?php echo $activity['User']['email'];?></td>
						<td><?php echo $activity['User']['phone_no'];?></td>
						<td><?php echo $activity['User']['zipcode'];?></td>
						<td><?php echo $activity['Activity']['ip'];?></td>
						<td><?php echo $activity['Activity']['date'];?></td>
						</tr>
						<?php } ?>
						</tbody>
					</table>
		                    <div class="text-center"><a href="<?php echo $this->webroot.'admin/users/activity_view'; ?>">View All Acivity</a> | <a href="<?php echo $this->webroot.'admin/users/activity_export'; ?>">Export Csv</a></div>
		                </div>
		            </div>
		        </div>
		    </div>

		    <!--<div class="row">
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
		        </div>
		        <div class="col-md-4">
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
		        </div>
		        <div class="col-md-4">

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
		        </div>
		    </div>

		    <div class="row">
		        <div class="col-md-4">
		            <div class="panel">
		                <div class="panel-body">
		                    <div class="calendar-block ">
		                        <div class="cal1">

		                        </div>
		                    </div>

		                </div>
		            </div>
		        </div>
		        <div class="col-md-4">
		            <div class="panel">
		                <header class="panel-heading">
		                    Todo List
		                    <span class="tools pull-right">
		                        <a class="fa fa-chevron-down" href="javascript:;"></a>
		                        <a class="fa fa-times" href="javascript:;"></a>
		                     </span>
		                </header>
		                <div class="panel-body">
		                    <ul class="to-do-list" id="sortable-todo">
		                        <li class="clearfix">
		                            <span class="drag-marker">
		                            <i></i>
		                            </span>
		                            <div class="todo-check pull-left">
		                                <input type="checkbox" value="None" id="todo-check"/>
		                                <label for="todo-check"></label>
		                            </div>
		                            <p class="todo-title">
		                                Dashboard Design & Wiget placement
		                            </p>
		                            <div class="todo-actionlist pull-right clearfix">

		                                <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
		                            </div>
		                        </li>
		                        <li class="clearfix">
		                            <span class="drag-marker">
		                            <i></i>
		                            </span>
		                            <div class="todo-check pull-left">
		                                <input type="checkbox" value="None" id="todo-check1"/>
		                                <label for="todo-check1"></label>
		                            </div>
		                            <p class="todo-title">
		                                Wireframe prepare for new design
		                            </p>
		                            <div class="todo-actionlist pull-right clearfix">

		                                <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
		                            </div>
		                        </li>
		                        <li class="clearfix">
		                            <span class="drag-marker">
		                            <i></i>
		                            </span>
		                            <div class="todo-check pull-left">
		                                <input type="checkbox" value="None" id="todo-check2"/>
		                                <label for="todo-check2"></label>
		                            </div>
		                            <p class="todo-title">
		                                UI perfection testing for Mega Section
		                            </p>
		                            <div class="todo-actionlist pull-right clearfix">

		                                <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
		                            </div>
		                        </li>
		                        <li class="clearfix">
		                            <span class="drag-marker">
		                            <i></i>
		                            </span>
		                            <div class="todo-check pull-left">
		                                <input type="checkbox" value="None" id="todo-check3"/>
		                                <label for="todo-check3"></label>
		                            </div>
		                            <p class="todo-title">
		                                Wiget & Design placement
		                            </p>
		                            <div class="todo-actionlist pull-right clearfix">

		                                <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
		                            </div>
		                        </li>
		                        <li class="clearfix">
		                            <span class="drag-marker">
		                            <i></i>
		                            </span>
		                            <div class="todo-check pull-left">
		                                <input type="checkbox" value="None" id="todo-check4"/>
		                                <label for="todo-check4"></label>
		                            </div>
		                            <p class="todo-title">
		                                Development & Wiget placement
		                            </p>
		                            <div class="todo-actionlist pull-right clearfix">

		                                <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
		                            </div>
		                        </li>

		                    </ul>
		                    <div class="row">
		                        <div class="col-md-12">
		                            <form role="form" class="form-inline">
		                                <div class="form-group todo-entry">
		                                    <input type="text" placeholder="Enter your ToDo List" class="form-control" style="width: 100%">
		                                </div>
		                                <button class="btn btn-primary pull-right" type="submit">+</button>
		                            </form>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <div class="col-md-4">
		            <div class="panel blue-box twt-info">
		                <div class="panel-body">
		                    <h3>19 Februay 2014</h3>

		                    <p>adminFilesEx is new model of adminFiles
		                    dashboard <a href="#">http://t.co/3laCVziTw4</a>
		                    4 days ago by John Doe</p>
		                </div>
		            </div>
		            <div class="panel">
		                <div class="panel-body">
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
		                </div>
		                <div class="panel-footer custom-trq-footer">
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
		                </div>
		            </div>
		        </div>
		    </div>-->
		</div>
		<!--body wrapper end-->
<style>
.title a{
    color: #fff !important;
}
</style>                    