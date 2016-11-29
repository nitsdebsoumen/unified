<style>
    .training-list {
        min-height: 400px;
    }
</style>
<div class="top-list-menu">
  <div class="menu">
  <ul>
      <li><a href="<?php echo $this->webroot; ?>"><?php echo HOME; ?></a></li>
        <li>></li>
        <li><a href="<?php echo $this->webroot.'users/courselisting'; ?>"><?php echo CATAGORY; ?></a></li>
     <li>></li>
        <li><a href="#"><?php echo $cat_name; ?></a></li>
    </ul>
    </div>
</div>
  
  
  <section class="listing_result">
    <div class="container">
      <div class="row training-list-area">

       
       <!-- <h4>Showing <span class="nmbr"><?php echo $limit; ?></span> of <span class="nmbr"><?php echo $countcat; ?></span> Courses</h4>-->
       
       <h4><?php echo $cat_name; ?></h4>

<div class="container">
  <div class="row">
    <div  id="posts-list">
<?php 

if (!empty($posts)) 
{
   
  foreach ($posts as $key => $value) 
  { 
     $id=$value['Post']['id'];


    ?>
        <div class="col-md-12 border_all_div">
          <div class="row">
            <div class="col-md-3 course_img">
            <?php if($value['Post']['featured']){ ?>  
              <div class="featured_course">Fearured</div>
            <?php } ?>
              <img src="<?php echo $this->webroot; ?>img/post_img/<?php echo $value['PostImage'][0]['originalpath'] ; ?>" class="img-responsive" style="margin:0 auto; width:253; height:133;" alt="" />
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-9">
                  <h3><?php echo $value['Post']['post_title']; ?></h3>
                </div>
                <div class="col-md-3">
                  <button class="btn btn-default enquary" ><i class="fa fa-graduation-cap" aria-hidden="true"></i><?php if($value['Post']['type_of_course']==0){ echo "Classroom"; } else{ echo "Online"; } ?></button>
                </div>
                <div class="col-md-12">
                 <!--  <p>The Institute of Chartered Accountants in England and Wales</p> -->
                  <p><?php echo substr( strip_tags($value['Post']['post_description']),0,strpos(strip_tags($value['Post']['post_description']),' ',100) ).'...'; ?></p>
                </div>
                <div class="col-md-3">
                 <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i><?php echo ' '.$value['Post']['address']; ?></span></p>
                </div>
                <div class="col-md-3">
                Rating:
                  <div class="star">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                </div>
                <div class="col-md-3">
                  <p><span class="price"><?php echo ' ₦ '.$value['Post']['price']; ?></span></p>
                </div>
                <div class="col-md-3">
                  <a href="<?php echo $this->webroot.'users/coursedetail/'.$value['Post']['slug']; ?>" ><button class="btn btn-default" type="submit">View Details</button></a>
                </div>
                </div>
              </div>
            </div>
          </div>
       

     
           <!--    <div  class="col-md-3" >
              <div class="training-list">
                      <img src="<?php echo $this->webroot; ?>img/post_img/<?php echo $value['PostImage'][0]['originalpath'] ; ?>" width="253" height="133"  alt=""/>
                        <h5><?php echo $value['Post']['post_title']; ?></h5>
                          <p><?php echo substr( strip_tags($value['Post']['post_description']),0,strpos(strip_tags($value['Post']['post_description']),' ',100) ).'...'; ?></p>
                          <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
                      <?php echo $value['Post']['address']; ?></span></p>
              <div class="star">
                          <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              </div>
                          <p><span class="price"><?php echo '$'.$value['Post']['price']; ?></span></p>
                          
                          <a href="<?php echo $this->webroot.'users/coursedetail/'.$value['Post']['slug']; ?>" > <button class="btn btn-default" type="submit" >View Details</button></a>
                      </div>
                    </div> -->
         
    <?php 

  }


  echo $this->Paginator->next();
}
  else
  {
    echo "There is no course of this category" ;
  }

  ?>
 </div>
    </div>
  </div>
    </div>
  </div>
</div>            

              
       
    
    
    
    
    
    
    
    <!-- <div class="container">
    	<div class="row"> -->
    	
    	
    		
    		
    		
    		
    		
 <!--    	</div>
    </div> -->
    
    
    <style>
    .border_all_div {padding:20px; border:1px solid #ccc; margin:10px 0;}
    .featured_course{width: 100px;background: #ee7c15;color: #fff;font-weight: bold;padding: 7px;text-align: center;position: absolute;top: -20px;left: -5px;right: 0;}
    .course_img img {height:192px;}
     </style>
    
</section>
<script>
  $(function(){
    $('.next').hide();
    var $container = $('#posts-list');
    $container.infinitescroll({
      navSelector  : '.next',    // selector for the paged navigation 
      nextSelector : '.next a',  // selector for the NEXT link (to page 2)
      itemSelector : '.border_all_div',     // selector for all items you'll retrieve
      debug         : true,
      dataType      : 'html',
      loading: {
          finishedMsg: 'No More Courses to load.',
          img: '<?php echo $this->webroot; ?>img/ajax-loader.gif'
        }
      }

    );

  });
</script>
