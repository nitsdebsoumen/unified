<style>
 #infscr-loading {
    display: block;
    margin: 0 auto;
    text-align: center;
    width: 100%;

}
#infscr-loading > img {
    display: block;
    margin: 0 auto;
    width: auto;
}
</style>


<div class="top-list-menu">
      <div class="menu">
      <ul>
          <li><a href="<?php echo $this->webroot; ?>"><?php echo HOME; ?></a></li>
            <li>></li>
            <li><a href="#"><?php echo CATAGORY; ?></a></li>
           <!-- <li>></li>
            <li><a href="#">Skill for health</a></li>-->
        </ul>
        </div>
    </div>
  
  
  <section class="listing_result">
    <div class="container">
      <div class="row training-list-area">
       <!-- <h4>Showing <span class="nmbr"><?php echo $limit; ?></span> of <span class="nmbr"><?php echo $countcat; ?></span> Courses</h4>-->
       
       <h4><?php echo ALL_CATAGORY; ?></h4>
	    <div class="category_new" id="posts-list">
        <?php 
foreach ($courses as $key => $value) { 
  $id=$value['Category']['id'];
  ?>
	   	  <div class="col-md-3" class="training-list" style="cursor:pointer;" onclick="javascript:window.location.href='<?php echo $this->webroot; ?>users/search/<?php echo $value['Category']['slug']; ?>'">
	   	  	<a class="category_box" style="border:none;">
            <?php if($value['CategoryImage'][0]['originalpath']!=''){?>
	   	  		<img src="<?php echo $this->webroot; ?>img/cat_img/<?php echo $value['CategoryImage'][0]['originalpath'] ; ?>" alt="" />
            <?php } 
            else{
            ?>
            <img src="<?php echo $this->webroot; ?>images/no_image.png" alt="" />
            <?php } ?>
	   	  		<hr></hr>
	   	  		<h3><?php echo $value['Category']['category_name']; ?></h3>
	   	  	</a>
	   	  </div>
  <?php 

}

echo $this->Paginator->next();

?>      
	   	  <!--<div class="col-md-3">
	   	  	<a class="category_box">
	   	  		<img src="<?php echo $this->webroot; ?>/images/abacus.png" alt="" />
	   	  		<hr></hr>
	   	  		<h3>Accounting & Finance</h3>
	   	  	</a>
	   	  </div>
	   	  <div class="col-md-3">
	   	  	<a class="category_box">
	   	  		<img src="<?php echo $this->webroot; ?>/images/abacus.png" alt="" />
	   	  		<hr></hr>
	   	  		<h3>Accounting & Finance</h3>
	   	  	</a>
	   	  </div>
	   	  <div class="col-md-3">
	   	  	<a class="category_box">
	   	  		<img src="<?php echo $this->webroot; ?>/images/abacus.png" alt="" />
	   	  		<hr></hr>
	   	  		<h3>Accounting & Finance</h3>
	   	  	</a>
	   	  </div>
	   	  <div class="col-md-3">
	   	  	<a class="category_box">
	   	  		<img src="<?php echo $this->webroot; ?>/images/abacus.png" alt="" />
	   	  		<hr></hr>
	   	  		<h3>Accounting & Finance</h3>
	   	  	</a>
	   	  </div>
	   	  <div class="col-md-3">
	   	  	<a class="category_box">
	   	  		<img src="<?php echo $this->webroot; ?>/images/abacus.png" alt="" />
	   	  		<hr></hr>
	   	  		<h3>Accounting & Finance</h3>
	   	  	</a>
	   	  </div>
	   	  <div class="col-md-3">
	   	  	<a class="category_box">
	   	  		<img src="<?php echo $this->webroot; ?>/images/abacus.png" alt="" />
	   	  		<hr></hr>
	   	  		<h3>Accounting & Finance</h3>
	   	  	</a>
	   	  </div>
	   	  <div class="col-md-3">
	   	  	<a class="category_box">
	   	  		<img src="<?php echo $this->webroot; ?>/images/abacus.png" alt="" />
	   	  		<hr></hr>
	   	  		<h3>Accounting & Finance</h3>
	   	  	</a>
	   	  </div>
	   </div>

<div  id="posts-list">
<div  class="col-md-3" >
<div class="training-list">
    <img src="<?php echo $this->webroot; ?>img/cat_img/<?php echo $value['CategoryImage'][0]['originalpath'] ; ?>" width="253" height="133"  alt=""/>
      <h5><?php echo $value['Category']['category_name']; ?></h5>
        <p><?php echo $value['Category']['category_description']; ?></p>
        <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
<?php echo $value['Country']['name']; ?></span></p>
<div class="star">
        <i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
</div>
        <p><span class="price"><?php //echo '$'.$value['Category']['price']; ?></span></p>
        
       <a href="<?php echo $this->webroot.'users/coursefilter/'.base64_encode($id); ?>" > <button class="btn btn-default" type="submit" >View Details</button></a>
    </div>
  </div>
</div>-->
        

              
       <!--   <div class="col-md-3">
          <div class="training-list">
                    <img src="<?php echo $this->webroot; ?>images/traning-list-pic-b.jpg" width="253" height="133"  alt=""/>
                      <h5>PHP Training Course</h5>
                        <p>Aliquam dapibus tincidunt metustmpliox sent justo dolor, lobortis...</p>
                        <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
Palos Verdes, California</span></p>
            <div class="star">
                        <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            </div>
                        <p><span class="price">$19.00</span></p>
                        
                        <button class="btn btn-default" type="submit">View Details</button>
                    </div>
        </div>
              
              <div class="col-md-3">
          <div class="training-list">
                    <img src="<?php echo $this->webroot; ?>images/traning-list-pic-c.jpg" width="253" height="133"  alt=""/>
                     <div class="upcoming">Upcoming</div>
                      <h5>PHP Training Course</h5>
                        <p>Aliquam dapibus tincidunt metustmpliox sent justo dolor, lobortis...</p>
                        <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
Palos Verdes, California</span></p>
            <div class="star">
                        <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            </div>
                        <p><span class="price">$19.00</span></p>
                        
                        <button class="btn btn-default" type="submit">View Details</button>
                    </div>
        </div>
              
              <div class="col-md-3">
          <div class="training-list">
                    <img src="<?php echo $this->webroot; ?>images/traning-list-pic-d.jpg" width="253" height="133"  alt=""/>
                      <h5>PHP Training Course</h5>
                        <p>Aliquam dapibus tincidunt metustmpliox sent justo dolor, lobortis...</p>
                        <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
Palos Verdes, California</span></p>
            <div class="star">
                        <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            </div>
                        <p><span class="price">$19.00</span></p>
                        
                        <button class="btn btn-default" type="submit">View Details</button>
                    </div>
        </div>
              
              <div class="col-md-3">
          <div class="training-list">
                    <img src="<?php echo $this->webroot; ?>images/traning-list-pic-e.jpg" width="253" height="133"  alt=""/>
                      <h5>PHP Training Course</h5>
                        <p>Aliquam dapibus tincidunt metustmpliox sent justo dolor, lobortis...</p>
                        <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
Palos Verdes, California</span></p>
            <div class="star">
                        <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            </div>
                        <p><span class="price">$19.00</span></p>
                        
                        <button class="btn btn-default" type="submit">View Details</button>
                    </div>
        </div>
              
              <div class="col-md-3">
          <div class="training-list">
                    <img src="<?php echo $this->webroot; ?>images/traning-list-pic-f.jpg" width="253" height="133"  alt=""/>
                      <h5>PHP Training Course</h5>
                        <p>Aliquam dapibus tincidunt metustmpliox sent justo dolor, lobortis...</p>
                        <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
Palos Verdes, California</span></p>
            <div class="star">
                        <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            </div>
                        <p><span class="price">$19.00</span></p>
                        
                        <button class="btn btn-default" type="submit">View Details</button>
                    </div>
        </div>
              
              <div class="col-md-3">
          <div class="training-list">
                    <img src="<?php echo $this->webroot; ?>images/traning-list-pic-g.jpg" width="253" height="133"  alt=""/>
                      <h5>PHP Training Course</h5>
                        <p>Aliquam dapibus tincidunt metustmpliox sent justo dolor, lobortis...</p>
                        <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
Palos Verdes, California</span></p>
            <div class="star">
                        <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            </div>
                        <p><span class="price">$19.00</span></p>
                        
                        <button class="btn btn-default" type="submit">View Details</button>
                    </div>
        </div>
              
              <div class="col-md-3">
          <div class="training-list">
                    <img src="<?php echo $this->webroot; ?>images/traning-list-pic-h.jpg" width="253" height="133"  alt=""/>
                      <h5>PHP Training Course</h5>
                        <p>Aliquam dapibus tincidunt metustmpliox sent justo dolor, lobortis...</p>
                        <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
Palos Verdes, California</span></p>
            <div class="star">
                        <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            </div>
                        <p><span class="price">$19.00</span></p>
                        
                        <button class="btn btn-default" type="submit">View Details</button>
                    </div>
        </div>
              
              <div class="col-md-3">
          <div class="training-list">
                    <img src="<?php echo $this->webroot; ?>images/traning-list-pic.jpg" width="253" height="133"  alt=""/>
                      <h5>PHP Training Course</h5>
                        <p>Aliquam dapibus tincidunt metustmpliox sent justo dolor, lobortis...</p>
                        <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
Palos Verdes, California</span></p>
            <div class="star">
                        <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            </div>
                        <p><span class="price">$19.00</span></p>
                        
                        <button class="btn btn-default" type="submit">View Details</button>
                    </div>
        </div>
              
              <div class="col-md-3">
          <div class="training-list">
                    <img src="<?php echo $this->webroot; ?>images/traning-list-pic-b.jpg" width="253" height="133"  alt=""/>
                      <h5>PHP Training Course</h5>
                        <p>Aliquam dapibus tincidunt metustmpliox sent justo dolor, lobortis...</p>
                        <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
Palos Verdes, California</span></p>
            <div class="star">
                        <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            </div>
                        <p><span class="price">$19.00</span></p>
                        
                        <button class="btn btn-default" type="submit">View Details</button>
                    </div>
        </div>
              
              <div class="col-md-3">
          <div class="training-list">
                    <img src="<?php echo $this->webroot; ?>images/traning-list-pic-c.jpg" width="253" height="133"  alt=""/>
                    <div class="upcoming">Upcoming</div>
                      <h5>PHP Training Course</h5>
                        <p>Aliquam dapibus tincidunt metustmpliox sent justo dolor, lobortis...</p>
                        <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
Palos Verdes, California</span></p>
            <div class="star">
                        <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            </div>
                        <p><span class="price">$19.00</span></p>
                        
                        <button class="btn btn-default" type="submit">View Details</button>
                    </div>
        </div>
              
              <div class="col-md-3">
          <div class="training-list">
                    <img src="<?php echo $this->webroot; ?>images/traning-list-pic-d.jpg" width="253" height="133"  alt=""/>
                      <h5>PHP Training Course</h5>
                        <p>Aliquam dapibus tincidunt metustmpliox sent justo dolor, lobortis...</p>
                        <p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
Palos Verdes, California</span></p>
            <div class="star">
                        <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            </div>
                        <p><span class="price">$19.00</span></p>
                        
                        <button class="btn btn-default" type="submit">View Details</button>
                    </div>
        </div>
        
      </div>
    </div>!-->
  </section>
<script>
  $(function(){
    $('.next').hide();
    var $container = $('#posts-list');
    $container.infinitescroll({
      navSelector  : '.next',    // selector for the paged navigation 
      nextSelector : '.next a',  // selector for the NEXT link (to page 2)
      itemSelector : '.col-md-3',     // selector for all items you'll retrieve
      debug         : true,
      dataType      : 'html',
      loading: {
          finishedMsg: '<?php echo NO_MORE_CATEGORY; ?>',
          img: '<?php echo $this->webroot; ?>img/ajax-loader.gif'
        }
      }

    );

  });
</script>
