<!-- Page Content -->

<section class="how-baner-section">
        <div class="container-fluid">
            <div class="row">
               <img  style="margin:0 auto; width:100%;" src="<?php echo $this->webroot?>images/blogss.jpg">
            </div>
        </div>
    </section>



    <div class="container">

<hr>
  <div class="row" style="padding:20px 0; margin-top:20px;">.
    <div class="col-md-8"> <h4>&nbsp;<!--Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s--></h4></div>
        <div class="col-md-4 right">
            <form method="post" action="">
            <div class="input-group">
                <input type="text" placeholder="Search blog" name="search_keyword" value="<?php echo isset($search_keyword)?$search_keyword:'';?>" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                       <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            </form>    
        </div>
  </div>
<hr>


        <!--<div class="row">
            <div class="col-md-12">
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
            </div>

        </div>-->


        <hr>

        <div class="row" style="padding:20px 0; margin-top:20px;">
            
            
            <?php 
            if(count($blog_list)>0){
                $uploadImgPath = WWW_ROOT.'blogs_image';
                $DivClassFlag=1;
                $BlogCnt=0;
                $DivClass4Flag=0;
                $DivClass6Flag=0;
                $MoreBlogCnt=0;
                foreach($blog_list as $val){
                    $BlogCnt++;
                    $BlogID=isset($val['Blog']['id'])?$val['Blog']['id']:'';
                    $BlogTitle=isset($val['Blog']['title'])?$val['Blog']['title']:'';
                    $BlogImage=isset($val['Blog']['image'])?$val['Blog']['image']:'';
                    $create_date=isset($val['Blog']['create_date'])?date('l jS, Y h:i A',strtotime($val['Blog']['create_date'])):'';
                    if($BlogImage!='' && file_exists($uploadImgPath . '/' . $BlogImage)){
                        $ImgLink=$this->webroot.'blogs_image/'.$BlogImage;
                    }else{
                        $ImgLink=$this->webroot.'noimage.png';
                    }
                    
                    if($DivClass4Flag>=0 && $DivClass4Flag<=2 && $DivClass6Flag==0){
                        $DivClass4Flag++;
                    }elseif($DivClass4Flag==3){
                        $DivClass4Flag=0;
                        $DivClass6Flag++;
                    }elseif($DivClass6Flag>=0 && $DivClass6Flag<=1 && $DivClass4Flag==0){
                        $DivClass6Flag++;
                    }elseif($DivClass6Flag==2){
                        $DivClass6Flag=0;
                        $DivClass4Flag++;
                    }
                    
                    if($DivClass4Flag>=1 && $DivClass4Flag<=3){
                        $DivClass='col-md-4 blog_three';
                    }else{
                        $DivClass='col-md-6 blog_two';
                    }
            ?>
                <!-- Blog Entries Column -->
            <div class="<?php echo $DivClass;?> text-center zoom-effect-container">
                <div class="gap">

                    <div class="image-card">
                        <div class="overlay"><a href="<?php echo $this->webroot?>blogs/details/<?php echo base64_encode($BlogID);?>"><h3>Read more</h3></a></div>  
                        <img  style="margin:0 auto;"  class="img-responsive"  src="<?php echo $ImgLink;?>"> 
                    </div>
                <!-- Pager -->
                <a href="<?php echo $this->webroot?>blogs/details/<?php echo base64_encode($BlogID);?>"><h3><?php echo $BlogTitle;?></h3></a>
                <p>Posted on <?php echo $create_date;?></p>
               </div>

            </div>
              
            <?php 
                    //hidden more blog
                    
                    if($BlogCnt>=5 && $BlogCnt%5==0){
                        $MoreBlogCnt++;
                        if($MoreBlogCnt==1){
                            $StyleDiv='style="display: block"';
                        //}elseif($BlogCnt < count($blog_list)) {
                        }else{    
                            $StyleDiv='style="display: none"';
                        }
                        echo '</div><div class="col-md-12 text-center" style="margin-bottom:20px;">
            <button type="button" '.$StyleDiv.' value="Show Div" id="MoreDiv_'.$BlogCnt.'" class="btn btn-primary btn-lg MoreDivClass">More Blogs..</button>
        </div><hr><div class="row" id="RowMoreDiv_'.$BlogCnt.'" style="padding:20px 0; margin-top:20px; display:none;">';
                    }
                }
            }else{
                echo '<div class="col-md-12 text-center"><p style="text-align: center;">No result found.</p></div> ';
            }
            
            ?>
            </div>

    </div>
    <!-- /.container -->
<script>
$(document).ready(function(){
    var divCnt=5;
    //$('.MoreDivClass').on('click', function () {
    $(".MoreDivClass").click(function () {    
        var NewDivCnt=parseInt(divCnt)+5;
        divCnt=NewDivCnt;
        var DivID=$(this).attr('id');
        $(this).hide();
        $('#Row'+DivID).show();   
        $('#MoreDiv_'+NewDivCnt).show();   
    });
    
});    
</script>

    <style type="text/css">
.image-card{position: relative;}
.overlay {background:rgba(0,0,0,0.5);
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: 99999;}
    .overlay, .image-card img {
  -webkit-transition: 0.4s ease;
  transition: 0.4s ease;
}

.zoom-effect-container:hover .image-card img {
  -webkit-transform: scale(1.08);
  transform: scale(1.08);
}
.zoom-effect-container:hover .overlay {
  -webkit-transform: scale(1.08);
  transform: scale(1.08);
}

.overlay h3{margin-top: 25%; color: #fff; text-align: center;}

.gap {margin-bottom: 20px;}


.blog_three > .gap > .image-card >img {width:360px; height: 240px;}

.blog_two > .gap >  .image-card > img  { width:555px; height: 365px;}
.gap h3 {
    min-height: 55px;
    font-size: 22px;
}
    </style>

    