<section class="login_body">

	<div class="container">
    	<div class="row">
            <?php echo($this->element('leftpanel'))?>
        	<div class="col-md-10 mid-div">
            	<div class="cart-section">
                 
                	<h1>Review History</h1>


<?php  //pr($user_reviews); 

                    if(!empty($user_reviews))
                    {    ?>
                           
                    	<table class="table table-bordered"> 
                        <thead > 
                        <tr> 
                        <th>Course</th> 
                        <th>User Name</th> 
                        <th>Rating</th> 
                        <th>action</th>
                        
                        </tr> 
                        </thead> 
                        <tbody id="table_data_user"> 
                        <tr> 
                        	<?php foreach($user_reviews as $value)
                                  {     ?>
                                        <td>
                                        	
                                        <div class="row">
                                        	<div class="col-md-2">
                                            	<?php if(!empty($value['User']['user_logo']) && $value['User']['user_logo']!=''){?>
                                                <img src="<?php echo $this->webroot; ?>user_logo/<?php echo $value['User']['user_logo']; ?>" style="margin:0 auto; height:65px; " alt="" />
                                                <?php } else{ ?>
                                                <img src="<?php echo $this->webroot; ?>images/no_image.png" style="margin:0 auto; height:65px; " alt="" />
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-10">
                                            <p><?php echo $value['Post']['post_title']; ?></p>
                                        <div class="seller">Provider:<span class="retailnet"><?php echo $value['User']['first_name'].''.$value['User']['last_name']; ?></span></div>
                                            </div>
                                        </div>
                                        
                                        </td> 
                                        <td class="one"><?php echo $value['Rating']['user_name'];?>
                                        </td> 
                                        <td>
                                        <div class="sale"><p><?php 
                                                      $count=$value['Rating']['comfort'];
                                                      for ($i=0; $i<$count ; $i++) { ?>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                      <?php }
                                                      $count_blk= 5-$count;
                                                      for ($i=0; $i<$count_blk ; $i++) { ?>
                                                       <i class="fa fa-star-o" aria-hidden="true"></i>   
                                                     
                                                      <?php }

                                                      ?>
                                                    </p></div>
                                        </td> 
                                        <td>
                                        <div class="multicolor"></div>
                                        </td> 
                                       
                                        </tr> 

                            <?php } ?>
                        </tbody> 
                        </table>
              <?php }
                    else
                    {
                      echo "There is no Course in Your Booking History"; 
                    }    
                    ?>
        

        </div>
            </div>
        </div>
    	
    </div>
</section>
<style>
    .form-group span {
    font-size: 17px;
    
    }
   .fa-fw {
        text-align: center;
        width: 1em;
        color:#ffb400;
    }
    .fa-star{ color:  #ffb400;}
    .fa-star-o{ color:  #ffb400;}

    
</style>
<style>
        .btn-primary {
            margin: 16px;
        }
        h5 {
          margin-left: 14px;
        }

        select{
            margin: 8px;
        }

        .form-control {
          width: 97%;
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
            width: 60px;
        }
</style>