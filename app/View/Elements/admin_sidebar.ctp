<?php

$uploadLogoFolder = "site_logo";
$uploadLogoPath = WWW_ROOT . $uploadLogoFolder;
$LogoName = $sitesetting['Setting']['logo'];
if(file_exists($uploadLogoPath . '/' . $LogoName) && $LogoName!=''){
    $LogoLink=$this->webroot.'site_logo/'.$LogoName;        
}else{
    $LogoLink=$this->webroot.'adminFiles/images/logo.png';  
}

if(!empty($role_restrictions)) {
    foreach ($role_restrictions as $key => $value) {
        $saved_accesibility[] = $value['Adminrolemeta']['meta_key']; 
    }
} else {
    $saved_accesibility = array();
}

//pr($userdetails);

?>
<!-- left side start-->
<div class="left-side sticky-left-side">

    <!--logo and iconic logo start-->
    <div class="logo">
        <a href="javascript:void(0);"><img src="<?php echo $LogoLink;?>" alt="" style="height: 41px;"></a>
    </div>

    <div class="logo-icon text-center">
        <a href="javascript:void(0);"><img src="<?php echo $LogoLink;?>" style="height: 60px;" alt=""></a>
    </div>
    <!--logo and iconic logo end-->

    <div class="left-side-inner">

        <!-- visible to small devices only -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">
            <div class="media logged-user">		            
                <div class="media-body">
                    <h4><a href="<?php echo $this->webroot?>admin/users/edit/<?php echo $userdetails['User']['id']; ?>"><?php echo($userdetails['User']['first_name'].' '.$userdetails['User']['last_name'])?></a></h4>
                </div>
            </div>

            <h5 class="left-nav-title">Account Information</h5>
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li><a href="<?php echo $this->webroot?>admin/users/edit/<?php echo $userdetails['User']['id']; ?>"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                <li><a href="<?php echo $this->webroot?>admin/users/changepwd"><i class="fa fa-user"></i> <span>Manage Password</span></a></li>
                <li><a href="<?php echo $this->webroot?>admin/users/logout"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">
<!--		        <li class="active"><a href="<?php echo $this->webroot?>admin/users/dashboard"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>-->

            <?php if($userdetails['User']['admin_type'] == '0' || in_array('manage_logo', $saved_accesibility) ) {  ?>
            <li class="<?php echo ($this->params['controller'] == 'settings' && $this->params['action'] == 'admin_sitelogo') ? 'active': ''; ?>">
                <a href="<?php echo $this->webroot?>admin/settings/sitelogo/1"><i class="fa fa-upload"></i> <span>Manage Logo</span></a>
            </li>
            <?php } ?>

            <li>
                <a href="<?php echo $this->webroot?>admin/dashboards/index"><i class="fa fa-home"></i> <span>Dashboard</span></a>
            </li>

            <li>
                <a href="<?php echo $this->webroot?>admin/settings/edit/1"><i class="fa fa-cog"></i> <span>Manage Settings</span></a>
            </li>

            <li class="menu-list <?php echo ($this->params['controller'] == 'adminroles') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Admin Roles</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'adminroles' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot?>admin/adminroles/index"> List Roles</a>
                    </li>

                    <li class="<?php echo ($this->params['controller'] == 'adminroles' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot?>admin/adminroles/add"> Add Roles</a>
                    </li>

                    <li class="<?php echo ($this->params['controller'] == 'adminroles' && $this->params['action'] == 'admin_privilege') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot?>admin/adminroles/privilege"> Set Privilege</a>
                    </li>
                </ul>
            </li>          

            <li class="menu-list <?php echo ($this->params['controller'] == 'cms_page') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Contents</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'cms_page' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/cms_page/index"> List Contents</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'cms_page' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/cms_page/add"> Add Contents</a>
                    </li>
                </ul>
            </li>


            <li class="menu-list <?php echo ($this->params['controller'] == 'faqs') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>FAQ</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'faqs' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/faqs/index"> List FAQ</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'faqs' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/faqs/add"> Add FAQ</a>
                    </li>
                    <li class="<?php echo ($this->params['action'] == 'admin_categories') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/faqs/categories"> Categories</a>
                    </li>
                    <li class="<?php echo ($this->params['action'] == 'admin_addcategory') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/faqs/addcategory"> Add Category</a>
                    </li>
                </ul>
            </li>

              <li class="menu-list <?php echo ($this->params['controller'] == 'suggest_categories') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Suggested Categories</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'suggest_categories' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/suggest_categories/index"> List Slider</a>
                    </li>
                
                </ul>
            </li>

            <li class="menu-list <?php echo ($this->params['controller'] == 'accreditations') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Accreditations</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'accreditations' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/accreditations/index"> List accreditations</a>
                    </li>
                
                </ul>
            </li>

            <!-- <li class="menu-list <?php echo ($this->params['controller'] == 'banners') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Banner</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'banners' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/banners/index"> List Banner</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'banners' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/banners/add"> Add Banner</a>
                    </li>
                </ul>
            </li> -->

            <li class="menu-list <?php echo ($this->params['controller'] == 'homesliders') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Home Slider</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'homesliders' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/homesliders/index"> List Slider</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'homesliders' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/homesliders/add"> Add Slider</a>
                    </li>
                </ul>
            </li>

            <!--            <li class="">
                            <a href=""><i class="fa fa-file-text"></i> <span>Footer</span></a>
                        </li>-->

            <li><a href="<?php echo $this->webroot?>admin/email_templates/index"><i class="fa fa-envelope"></i> <span>Email Templates</span></a></li>

            <!--<li class="menu-list <?php //echo ($this->params['controller'] == 'users' && ($this->params['action'] != 'admin_contact_us' && $this->params['action'] != 'admin_contact_us_add') ) ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Users</span></a>
                <ul class="sub-menu-list">
                    
                    <li class="<?php //echo ($this->params['controller'] == 'users' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php //echo $this->webroot; ?>admin/users/list"> List Users</a>
                    </li>
                    <li class="<?php //echo ($this->params['controller'] == 'users' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php //echo $this->webroot; ?>admin/users/add"> Add Users</a>
                    </li>
                </ul>
            </li>-->

            <li class="menu-list <?php echo ($this->params['controller'] == 'trainingproviders') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Training Providers</span></a>
                <ul class="sub-menu-list">

                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/trainingproviders/index"> Training Providers</a>
                    </li>
                    <li class="<?php echo ($this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/trainingproviders/add"> Add Training Provider</a>
                    </li>
                </ul>
            </li>

            <li class="menu-list  <?php echo ($this->params['controller'] == 'venueproviders') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span> Venue Providers</span></a>
                <ul class="sub-menu-list">

                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/venueproviders/index"> Venue Providers</a>
                    </li>
                    <li class="<?php echo ($this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/venueproviders/add"> Add Venue Provider</a>
                    </li>
                </ul>
            </li>

            <li class="menu-list  <?php echo ($this->params['controller'] == 'corporateusers') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Corporate Users</span></a>
                <ul class="sub-menu-list">

                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/corporateusers/index"> Corporate Users</a>
                    </li>
                    <li class="<?php echo ($this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/corporateusers/add"> Add Corporate User</a>
                    </li>
                </ul>
            </li>
            <li class="menu-list  <?php echo ($this->params['controller'] == 'indivisualusers') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Indivisual Users</span></a>
                <ul class="sub-menu-list">

                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/indivisualusers/index"> Indivisual Users</a>
                    </li>
                    <li class="<?php echo ($this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/indivisualusers/add"> Add Indivisual User</a>
                    </li>
                </ul>
            </li>

            <li class="menu-list <?php echo ($this->params['controller'] == 'categories') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Course Categories</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'categories' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/categories/index"> List Categories</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'categories' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/categories/add"> Add Category</a>
                    </li>
                </ul>
            </li>
            
            <!-- <li class="menu-list <?php echo ($this->params['controller'] == 'skills') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Course Skills</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'skills' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/skills/index"> List Skills</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'skills' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/skills/add"> Add Skills</a>
                    </li>
                </ul>
            </li> -->

            <li class="menu-list <?php echo ($this->params['controller'] == 'posts') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-file-text"></i> <span>Courses</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'posts' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/posts/index"> List Courses</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'posts' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/posts/add"> Add Course</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'posts' && $this->params['action'] == 'admin_import_csv') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/posts/import_csv"> Upload From CSV</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'posts' && $this->params['action'] == 'admin_featured_course') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/posts/featured_course"> Featured Course</a>
                    </li>
                </ul>
            </li>

            <li class="<?php echo ($this->params['controller'] == 'course_requests' && $this->params['action'] == 'admin_index') ? 'active': ''; ?>">
                <a href="<?php echo $this->webroot; ?>admin/course_requests/index"><i class="fa fa-file-text"></i> <span>Course Requests</span></a>
            </li>

<!--    <li class="menu-list <?php echo ($this->params['controller'] == 'marketplaces') ? 'nav-active': ''; ?>">
    <a href=""><i class="fa fa-shopping-cart"></i> <span>MatchMaker</span></a>
    <ul class="sub-menu-list">
        <li class="<?php echo ($this->params['controller'] == 'marketplaces' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
            <a href="<?php echo $this->webroot; ?>admin/marketplaces/index"> List Market Places</a>
        </li>
        <li class="<?php echo ($this->params['controller'] == 'marketplaces' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
            <a href="<?php echo $this->webroot; ?>admin/marketplaces/add"> Add Market Places</a>
        </li>
    </ul>
</li>

<li class="menu-list <?php echo ($this->params['controller'] == 'sales') ? 'nav-active': ''; ?>">
    <a href=""><i class="fa fa-pencil"></i> <span>Sales</span></a>
    <ul class="sub-menu-list">
        <li class="<?php echo ($this->params['controller'] == 'sales' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
            <a href="<?php echo $this->webroot; ?>admin/sales/index"> List Sales</a>
        </li>
        <li class="<?php echo ($this->params['controller'] == 'sales' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
            <a href="<?php echo $this->webroot; ?>admin/sales/add"> Add Sales</a>
        </li>
    </ul>
</li> !-->

            <li class="menu-list <?php echo ($this->params['controller'] == 'membership_plans') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-pencil"></i> <span>Feature Membership Plans</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'membership_plans' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/membership_plans/index"> List Feature Membership</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'membership_plans' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/membership_plans/add"> Add Feature Membership</a>
                    </li>
                </ul>
            </li>

            <li class="menu-list <?php echo ($this->params['controller'] == 'users' && ($this->params['action'] == 'admin_contact_us' || $this->params['action'] == 'admin_contact_us_add')) ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-mobile"></i> <span>Contact Us</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'users' && $this->params['action'] == 'admin_contact_us') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/users/contact_us"> List Contact</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'users' && $this->params['action'] == 'admin_contact_us_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/users/contact_us_add"> Add Contact</a>
                    </li>
                </ul>
            </li>

            
            <li class="menu-list <?php echo ($this->params['controller'] == 'partners') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-ticket"></i> <span>Partners</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'partners' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/partners/"> List Partners</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'partners' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/partners/add"> Add Partner</a>
                    </li>
                </ul>
            </li>
            <li class="menu-list <?php echo ($this->params['controller'] == 'featured_plans') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-ticket"></i> <span>Feature Plans</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'featured_plans' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/featured_plans/"> List Plans</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'featured_plans' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/featured_plans/add"> Add Plan</a>
                    </li>
                </ul>
            </li>
            
            <li class="<?php echo ($this->params['controller'] == 'Seos' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                <a href="<?php echo $this->webroot; ?>admin/Seos/listing"><i class="fa fa-ticket"></i> <span>List SEO Keywords</span></a>
            </li>

            <li class="<?php echo ($this->params['controller'] == 'enquiries' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                <a href="<?php echo $this->webroot; ?>admin/enquiries/index"><i class="fa fa-ticket"></i> <span>List Enquiries</span></a>
            </li>
                    
<!--            <li class="menu-list <?php //echo ($this->params['controller'] == 'Seos') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-ticket"></i> <span>SEO Keywords Management</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php //echo ($this->params['controller'] == 'Seos' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php //echo $this->webroot; ?>admin/Seos/listing"> List SEO Keywords</a>
                    </li>
                    <li class="<?php //echo ($this->params['controller'] == 'Seos' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php //echo $this->webroot; ?>admin/Seos/add"> Add SEO Keywords</a>
                    </li>
                </ul>
            </li>-->

            <!-- <li class="menu-list <?php echo ($this->params['controller'] == 'Languages') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-camera"></i> <span>Language Management</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'Languages' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/Languages/listing"> List Languages</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'Languages' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/Languages/add"> Add Languages</a>
                    </li>
                </ul>
            </li> -->

            <li class="">
                <a href="<?php echo $this->webroot; ?>admin/lang_resources"><i class="fa fa-cog"></i> Language Resources</a>
            </li>

            <li class="menu-list <?php echo ($this->params['controller'] == 'Sitemaps') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-ticket"></i> <span>Sitemaps</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'Sitemaps' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/Sitemaps/listing"> List Sitemap</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'Sitemaps' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/Sitemaps/add"> Add Sitemap</a>
                    </li>
                </ul>
            </li>

            <li class="menu-list <?php echo ($this->params['controller'] == 'Analytics') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-mobile"></i> <span>Analytics</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'Analytics' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/Analytics/listing"> List Analytics</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'Analytics' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/Analytics/add"> Add Analytics</a>
                    </li>
                </ul>
            </li>

            <li class="menu-list <?php echo ($this->params['controller'] == 'Seourls') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-mobile"></i> <span>Seo URL</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'Seourls' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/Seourls/index"> List Seo URL</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'Seourls' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/Seourls/add"> Add Seo URL</a>
                    </li>
                </ul>
            </li>




            <li class="menu-list <?php echo ($this->params['controller'] == 'SocialMedias') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-mobile"></i> <span>Social Medias</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['controller'] == 'SocialMedias' && $this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/SocialMedias/listing"> List Social Media</a>
                    </li>
                    <li class="<?php echo ($this->params['controller'] == 'SocialMedias' && $this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/SocialMedias/add"> Add Social Media</a>
                    </li>
                </ul>
            </li>

            <li class="menu-list <?php echo ($this->params['controller'] == 'newsletters') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-mobile"></i> <span>Newsletter</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/newsletters/index"> List Newsletter</a>
                    </li>
                    <li class="<?php echo ($this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/newsletters/add"> Add Newsletter</a>
                    </li>
                </ul>
            </li> 
            <li class="menu-list <?php echo ($this->params['controller'] == 'venues') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-mobile"></i> <span>Venue</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/venues/index"> List Venue</a>
                    </li>
                    <li class="<?php echo ($this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/venues/add"> Add Venue</a>
                    </li>
                </ul>
            </li>

            <li class="menu-list <?php echo ($this->params['controller'] == 'kycdocs') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-mobile"></i> <span>KYC Verification</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/kycdocs/index"> List KYC</a>
                    </li>
                    <li class="<?php echo ($this->params['action'] == 'admin_add') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/kycdocs/add"> Add KYC</a>
                    </li>
                </ul>
            </li> 
            <li class="menu-list <?php echo ($this->params['controller'] == 'orders') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-mobile"></i> <span>Orders</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/orders/index"> List Orders</a>
                    </li>
                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/orders/add"> Add Orders</a>
                    </li>
                  
                </ul>
            </li> 

            <li class="menu-list <?php echo ($this->params['controller'] == 'request_quotes') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-quote-left"></i> <span>Quotes</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/request_quotes/index"> List Quotes</a>
                    </li>
                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/request_quotes/add"> Add Quotes</a>
                    </li>
                  
                </ul>
            </li>

            <li class="menu-list <?php echo ($this->params['controller'] == 'promo_codes') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-tags"></i> <span>Promo Codes</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/promo_codes/index"> List Promo Codes</a>
                    </li>
                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/promo_codes/add"> Add Promo Code</a>
                    </li>
                  
                </ul>
            </li>
            <li class="menu-list <?php echo ($this->params['controller'] == 'reports') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-tags"></i> <span>Reports</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/reports/index"> List Reports</a>
                    </li>
                                  
                </ul>
            </li>
            <li class="menu-list <?php echo ($this->params['controller'] == 'membership_orders') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-users"></i> <span>Feature Provider Orders</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/membership_orders/index"> List Feature Provider Orders</a>
                    </li>
                    <!-- <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/membership_orders/add"> Add Promo Code</a>
                    </li> -->
                  
                </ul>
            </li>
            <li class="menu-list <?php echo ($this->params['controller'] == 'withdrawal_requests') ? 'nav-active': ''; ?>">
                <a href=""><i class="fa fa-tags"></i> <span>Withdrawal Requests</span></a>
                <ul class="sub-menu-list">
                    <li class="<?php echo ($this->params['action'] == 'admin_index') ? 'active' : ''; ?>">
                        <a href="<?php echo $this->webroot; ?>admin/withdrawal_requests/index"> List Withdrawal Requests</a>
                    </li>
                                  
                </ul>
            </li>





        </ul>
        <!--sidebar nav end-->

    </div>
</div>
<!-- left side end-->
