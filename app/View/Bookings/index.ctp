<?php //pr($order_list); exit;?>
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
 <div id="loading">
            <img src="<?php echo $this->webroot; ?>/images/ajax-loader.gif" />
        </div>
<section class="login_body">

	<div class="container">
    	<div class="row">
            <?php echo($this->element('leftpanel'))?>
        	<div class="col-md-9 mid-div">
            	<div class="cart-section">
                    <?php   if($user_type=='1' || $user_type=='2'){  ?>
                    <form method="post" action="">
                        <button class="btn btn-primary pull-right" id="download_csv" name="downloadcsv" type="submit">Download CSV</button>
                    </form>
                    <?php } ?>
                	<h1>Booking History</h1>


<?php   if($user_type=='3' || $user_type=='4')
        { 

                    if(!empty($order_list))
                    {    ?>

                            <form action="#" method="post" id="search_form_user" >
                                
                                <h5>Search by Course</h5>
                                 <select name="course" class="form-control border" id="course_id">
                                            <option value="" >Select Option</option>
                                            <option value="">All</option>
                                            <?php
                                            foreach($course_lists as $course_list)
                                            {
                                                ?>
                                                    <option value="<?php echo $course_list['Post']['id']; ?>" ><?php echo $course_list['Post']['post_title']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                <input type="button" class="btn btn-primary pull-right" value="Submit" id="form_submit_user">
                            </form>

                    	<table class="table table-bordered"> 
                        <thead > 
                        <tr> 
                        <th>Course</th> 
                        <th>No. of Booking</th> 
                        <th>Price</th> 
                        <th>Course Details</th>
                        <th>Subtotal</th>
                        </tr> 
                        </thead> 
                        <tbody id="table_data_user"> 
                        <tr> 
                        	<?php foreach($order_list as $value)
                                  {     
                                        if($value['Post']['User']['user_logo']!=''){
                                          $img = $this->webroot.'user_logo/'.$value['Post']['User']['user_logo'];
                                        }
                                        else{
                                          $img = $this->webroot.'images/no_image.png';   
                                        }

                                    ?>
                                        <td>
                                        	
                                        <div class="row">
                                        	<div class="col-md-2">
                                            	<img src="<?php echo $img;?>" style="width:38px;" >
                                            </div>
                                            <div class="col-md-10">
                                            <p><?php echo $value['Post']['post_title']; ?></p>
                                        <div class="seller">Provider:<span class="retailnet"><?php echo $value['User']['first_name'].''.$value['User']['last_name']; ?></span></div>
                                            </div>
                                        </div>
                                        
                                        </td> 
                                        <td class="one"><?php echo $value['OrderItem']['quantity'];?>
                                        </td> 
                                        <td>
                                        <div class="sale">Course Price: Rs. <?php echo $value['Post']['price'];?></div>
                                        </td> 
                                        <td>
                                        <div class="multicolor"><?php echo $value['Post']['post_description'];?></div>
                                        </td> 
                                        <td><b><?php echo '$'.$value['Post']['price']*$value['OrderItem']['quantity'];?></b></td> 
                                        </tr> 

                            <?php } ?>
                        </tbody> 
                        </table>
              <?php }
                    else
                    {
                      echo "There is no Course in Your Booking History"; 
                    }    
        }
        else
        {

                if(!empty($order_list))
                {    ?>
                    
                        <form action="#" method="post" id="search_form" >
                            
                            <h5>Search by Course</h5>
                             <select name="course" class="form-control border" id="course_id">
                                        <option value="" >Select Option</option>
                                        <option value="">All</option>
                                        <?php
                                        foreach($user_posts as $user_post)
                                        {
                                            ?>
                                                <option value="<?php echo $user_post['Post']['id']; ?>" ><?php echo $user_post['Post']['post_title']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                            <input type="button" class="btn btn-primary pull-right" value="submit" id="form_submit">
                         </form>
                        <table class="table table-bordered"> 
                        <thead> 
                        <tr> 
                        <th>Course</th> 
                        <th>No. of Booking</th> 
                        <th>Price</th> 
                        <th>User Name</th>
                        <th>Course Delails</th>
                        </tr> 
                        </thead> 
                        <tbody id="table_data" > 
                        <tr> 
                            

                        <?php foreach($order_list as $value)
                              { 
                                if($value['Post']['User']['user_logo']!=''){
                                  $img = $this->webroot.'user_logo/'.$value['Post']['User']['user_logo'];
                                }
                                else{
                                  $img = $this->webroot.'images/no_image.png';   
                                }

                                ?>
                                <td>
                                	
                                <div class="row">
                                	<div class="col-md-2">
                                    	<img src="<?php echo $img;?>" style="width:42px;" >
                                    </div>
                                    <div class="col-md-10">
                                    <p><?php echo $value['Post']['post_title']; ?></p>
                                <div class="seller">Provider:<span class="retailnet"><?php echo $value['User']['first_name'].''.$value['User']['last_name']; ?></span></div>
                                    </div>
                                </div>
                                
                                </td> 
                                <td class="one"><?php echo $value['Order']['quantity'];?>
                                </td> 
                                <td>
                               
                                <div class="sale">Course Price: Rs. <?php echo $value['Post']['price'];?></div>
                                
                                </td> 
                                <td>
                               
                                <div class="multicolor"><?php echo $value['User']['first_name'].''.$value['User']['last_name'];?></div>
                                </td> 
                                <td><b><?php echo $value['Post']['post_description'];?></b></td> 
                                </tr>
                   
                    <?php                  
                          } ?>
                     
                        </tbody> 
                        </table>

         <?php  }
                else
                {
                   	echo "No One have Booked your course";
                }


        } ?>

        </div>
            </div>
        </div>
    	
    </div>
</section>
<script>
    (function($){
        $('#form_submit').click(function(){
            $('#loading').show();
            $.ajax({
                url: "<?php echo $this->webroot;?>bookings/ajaxSearch",
                type:'POST',
                dataType:'json',
                data:$("#search_form").serialize(),
                success: function(result){
                    $('#loading').hide();
                    if(result.ack == '1') {
                      $('#table_data').html(result.html);
                    }
               }
            });
        });

        $('#form_submit_user').click(function(){
            $('#loading').show();
            $.ajax({
                url: "<?php echo $this->webroot;?>bookings/ajaxSearchUser",
                type:'POST',
                dataType:'json',
                data:$("#search_form_user").serialize(),
                success: function(result){
                    $('#loading').hide();
                    if(result.ack == '1') {
                      $('#table_data_user').html(result.html);
                    }
               }
            });
        });

    })(jQuery);
</script>
<style>
.mid-div
{
float:left !important;
}
</style>

  

    
