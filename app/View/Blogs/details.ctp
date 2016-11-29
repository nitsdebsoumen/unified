<?php
    $uploadImgPath = WWW_ROOT.'blogs_image';
    $BlogTitle=isset($blog_details['Blog']['title'])?$blog_details['Blog']['title']:'';
    $BlogImage=isset($blog_details['Blog']['image'])?$blog_details['Blog']['image']:'';
    $BlogDesc=isset($blog_details['Blog']['description'])?$blog_details['Blog']['description']:'';
    $create_date=isset($blog_details['Blog']['create_date'])?date('l jS, Y h:i A',strtotime($blog_details['Blog']['create_date'])):'';
    if($BlogImage!='' && file_exists($uploadImgPath . '/' . $BlogImage)){
        $SingleImgLink=$this->webroot.'blogs_image/'.$BlogImage;
    }else{
        $SingleImgLink=$this->webroot.'noimage.png';
    }
    $link = Configure::read('SITE_URL').'blogs/details/'.base64_encode($blog_details['Blog']['id']);
    $UserID=$this->Session->read('userid');
?>
<script>
function popWindow(url,winName,w,h) {
    if (window.open) {
        if (poppedWindow) { poppedWindow = ''; }
        windowW = w;
        windowH = h;
        var windowX = (screen.width/2)-(windowW/2);
        var windowY = (screen.height/2)-(windowH/2);
        var myExtra = "status=no,menubar=no,resizable=yes,toolbar=no,scrollbars=yes,addressbar=no";
        var poppedWindow = window.open(url,winName,'width='+w+',height='+h+',top='+windowY+',left=' + windowX + ',' + myExtra + '');
    }
    else {
        alert('Your security settings are not allowing our popup windows to function. Please make sure your security software allows popup windows to be opened by this web application.');
    }
    return false;
}
</script>
<!-- Page Content -->
    <div class="container">
        <div class="row" style="padding:20px 0;">
            <!-- Blog Post Content Column -->
            <div class="col-md-9" style="margin-bottom:20px;">
                <!-- Blog Post -->
                <!-- Title -->
                <h1><?php echo $BlogTitle;?></h1>
                <!-- Author -->
                <p class="lead">
                    by <a href="Javascript: void(0);">Start Errand</a>
                </p>
                
                <p> 
                    <div class="follow" style="overflow:hidden;">
                        <a href="Javascript: void(0)" class="fa fa-facebook" style="background:#153892" onclick="popWindow('http://www.facebook.com/sharer.php?u=<?php echo $link;?>','Facebook','500','400')"></a>
                        <a href="Javascript: void(0)" class="fa fa-twitter" style="background:#1eacfb" onclick="popWindow('http://twitter.com/share?url=<?php echo $link;?>','Twitter','500','258')"></a>
                        <a href="Javascript: void(0)" class="fa fa-google-plus" style="background:red" onclick="popWindow('https://plus.google.com/share?url=<?php echo $link;?>','Google Plus','500','400')"></a>
                        <a href="Javascript: void(0)" class="fa fa-pinterest-p" style="background:#820a0f" onclick="popWindow('https://www.pinterest.com/pin/create/button/?url=<?php echo $link;?>','Pinterest','500','400')"></a>
                    </div>
                </p>

                <hr>
                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $create_date;?></p>
                <hr>
                <!-- Preview Image -->
                <img style="margin:0 auto;" class="img-responsive" src="<?php echo $SingleImgLink;?>" alt="">
                <hr>
                <!-- Post Content -->
                <!--<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>-->
                <?php echo $BlogDesc;?>

               

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <?php 
                    if(isset($UserID) && $UserID !=''){
                    ?>
                        
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="3" required="required"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <?php
                    }else{
                    ?>
                        <ul class="button_holder">
                            <li>
                                    <a href="<?php echo $this->webroot?>users/signup" class="btn orng" style="color:#fff">JOIN</a>
                            </li>
                            <li><span>Or</span></li>
                            <li>
                            <a href="<?php echo $this->webroot?>users/login" class="btn deep" style="color:#fff">LOGIN</a>
                            </li>
                        </ul>
                    <?php }?>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php
                if(count($BlogsComments)>0){
                    $uploadUserImgPath = WWW_ROOT.'user_images';
                    foreach($BlogsComments as $comment){
                        $UserName=isset($comment['User']['first_name'])?$comment['User']['first_name'].' '.$comment['User']['last_name']:'';
                        $Comment=isset($comment['BlogComment']['comment'])?$comment['BlogComment']['comment']:'';
                        $comment_date=isset($comment['BlogComment']['cdate'])?date('l jS, Y h:i A',strtotime($comment['BlogComment']['cdate'])):'';
                        $UserImage=isset($comment['User']['profile_img'])?$comment['User']['profile_img']:'';
                        if($UserImage!='' && file_exists($uploadUserImgPath . '/' . $UserImage)){
                            $UserImgLink=$this->webroot.'user_images/'.$UserImage;
                        }else{
                            $UserImgLink=$this->webroot.'user_images/default.png';
                        }
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="<?php echo $UserImgLink;?>" height="64px" width="64px" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $UserName;?>
                            <small><?php echo $comment_date;?></small>
                        </h4>
                        <?php echo $Comment;?>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->

            <div class="col-md-3 text-center">

                <div class="alliswell">
                    <h4>Blog Categories</h4>
                    <hr>
                    <div class="row">
                        
                        <div class="col-lg-12">
                            <!--<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php
                                $CntCat=0;
                                if(isset($categories) && !empty($categories)){
                                    foreach($categories as $category){
                                        $CntCat++;
                                ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="">
                                          <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo 'collapse_'.$CntCat;?>" aria-expanded="true" aria-controls="<?php echo 'collapse_'.$CntCat;?>">
                                                <?php echo $category['Category']['name'];?>
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="<?php echo 'collapse_'.$CntCat;?>" class="panel-collapse collapse <?php if($CntCat==1){ echo 'in';}?>" role="tabpanel" aria-labelledby="headingOne">
                                          <div class="panel-body">
                                           <ul class="list-unstyled">
                                               <?php
                                               $subcats = $this->requestAction(array('controller' => 'tasks', 'action' => 'getsubcat/'.$category['Category']['id']));
                                                if(!empty($subcats)){
                                                    foreach($subcats as $subcat){
                                                        $subCatID=$subcat['Category']['id'];
                                                        $SubCatName=$subcat['Category']['name'];
                                                        $SubCatLink=$this->webroot.'blogs/index/'.base64_encode($subCatID);
                                                        echo '<li><a href="'.$SubCatLink.'">'.$SubCatName.'</a></li>';
                                                    }
                                                }
                                               ?>
                                            </ul>
                                          </div>
                                        </div>
                                    </div>
                                <?php
                                        
                                    }
                                }
                                ?>
                            </div>-->
                            <div class="accordion" id="accordion2">
                                <?php
                                $CntCat=0;
                                if(isset($categories) && !empty($categories)){
                                    foreach($categories as $category){
                                        $CntCat++;
                                ?>
                                <div class="accordion-group">
                                    <div class="accordion-heading" style="">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo 'collapse_'.$CntCat;?>"><?php echo $category['Category']['name'];?></a>
                                    </div>
                                    <div id="<?php echo 'collapse_'.$CntCat;?>" class="accordion-body collapse <?php if($CntCat==1){ echo 'in';}?>">
                                        <div class="accordion-inner">
                                            <ul class="list-unstyled">
                                                <?php
                                                $subcats = $this->requestAction(array('controller' => 'tasks', 'action' => 'getsubcat/'.$category['Category']['id']));
                                                if(!empty($subcats)){
                                                    foreach($subcats as $subcat){
                                                        $subCatID=$subcat['Category']['id'];
                                                        $SubCatName=$subcat['Category']['name'];
                                                        $SubCatLink=$this->webroot.'blogs/index/'.base64_encode($subCatID);
                                                        echo '<li><a href="'.$SubCatLink.'">'.$SubCatName.'</a></li>';
                                                    }
                                                }
                                               ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                        
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
           <hr>

        </div>
        <!-- /.row -->
        <?php
        if(isset($RelatedBlogs) && count($RelatedBlogs)>0){
        ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Related Blogs</h3>
                <hr>
            </div>
            <?php
            foreach($RelatedBlogs as $val){
                $SBlogID=isset($val['Blog']['id'])?$val['Blog']['id']:'';
                $SBlogTitle=isset($val['Blog']['title'])?$val['Blog']['title']:'';
                $SBlogImage=isset($val['Blog']['image'])?$val['Blog']['image']:'';
                if($SBlogImage!='' && file_exists($uploadImgPath . '/' . $SBlogImage)){
                    $ImgLink=$this->webroot.'blogs_image/'.$SBlogImage;
                }else{
                    $ImgLink=$this->webroot.'noimage.png';
                }
            ?>
            <div class="col-md-4 text-center zoom-effect-container">
                <div class="gap">
                    <div class="image-card">
                        <img  style="margin:0 auto;"  class="img-responsive"  src="<?php echo $ImgLink;?>"> </div>
                <!-- Pager -->
                <a href="<?php echo $this->webroot?>blogs/details/<?php echo base64_encode($SBlogID);?>"><h3><?php echo $SBlogTitle;?></h3></a>
               </div>

            </div>
            <?php
            }
            ?>
        </div>

        <hr>
        <?php }?>
        <!-- Footer -->
       

    </div>
    <!-- /.container -->

<style type="text/css">
.alliswell {border: 1px solid #ccc; min-height: 30px; padding: 19px;}
ul.list-unstyled > li {padding: 2px 0;}
ul.list-unstyled > li a {color: #000; text-decoration: none;}
.button_holder {
    display: table;
    list-style: outside none none;
    margin: 20px auto;
    padding: 0;
}
.button_holder li {
    float: left;
}
.list-unstyled { text-align:left;}
.button_holder li span {
    display: block;
    line-height: 35px;
    padding: 0 10px;
    text-transform: uppercase;
}
.panel-title {text-align:left;}


.accordion-toggle:after {
    font-family: 'FontAwesome';
    content: "\f078";    
    float: right;
}
.accordion-opened .accordion-toggle:after {    
    content: "\f054";    
}

.accordion-heading {background-image: linear-gradient(to bottom, #f5f5f5 0%, #e8e8e8 100%);color: #333333;background-color: #f5f5f5;border-color: #dddddd; padding: 10px;
text-align: left;}
</style>
    <!-- /.container -->
<script type="text/javascript">
$(document).on('show','.accordion', function (e) {
     //$('.accordion-heading i').toggleClass(' ');
     $(e.target).prev('.accordion-heading').addClass('accordion-opened');
});

$(document).on('hide','.accordion', function (e) {
    $(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');
    //$('.accordion-heading i').toggleClass('fa-chevron-right fa-chevron-down');
});

</script>


  
    