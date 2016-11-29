<section class="login_body">

	<div class="container">
    	<div class="row">
            <?php echo($this->element('leftpanel'))?>
        	<div class="col-md-10 mid-div">
            	<div class="cart-section">
                 
                	<h1>User Enquiries</h1>


<?php  //pr($user_reviews); 

                    if(!empty($user_enquiry))
                    {    ?>
                           
                    	<table class="table table-bordered"> 
                        <thead > 
                        <tr> 
                        <th>Subject</th>
                        <th>Post Title</th> 
                        <th>User Name</th> 
                        <th>Email</th> 
                        <th>Query</th>
                        <th>Action</th>
                        
                        </tr> 
                        </thead> 
                        <tbody id="table_data_user"> 
                        <tr> 
                        	<?php foreach($user_enquiry as $value)
                                  {     ?>
                                        <td class="one"><?php echo $value['Enquiry']['subject'];?>
                                        </td>
                                        <td class="one"><?php echo $value['Post']['post_title'];?>
                                        <td class="one"><?php echo $value['Enquiry']['user_name'];?>
                                        </td> 
                                        <td class="one"><?php echo $value['Enquiry']['email'];?>
                                        </td> 
                                        <td class="one"><?php echo $value['Enquiry']['query'];?>
                                        </td>
                                       	<td class="one"> <button type="button" class="btn btn-default reply_enquiry" data-id="<?php echo $value['Enquiry']['id']; ?>" data-toggle="modal" data-target="#myModal">Reply</button>
                                       		<a href="<?php echo $this->webroot;?>enquiries/delete_enquiries/<?php echo base64_encode($value['Enquiry']['id']); ?>" >
                                       			<button type="button" class="btn btn-danger ">Delete</button></a>
                                        </td>

                                        </tr> 

                            <?php } ?>
                        </tbody> 
                        </table>
              <?php }
                    else
                    {
                      echo "There is no Enquiry"; 
                    }    
                    ?>
        

        </div>
            </div>
        </div>
    	
    </div>

    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Write Your Reply Mail</h4>
        </div>
        		<div class="right_bar">
                    <form class="form-horizontal" id="reply_form">
                        
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Reply Mail:</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control border" id="reply" name="data[reply]" value="" required="required" placeholder="Write Your Mail" ></textarea>
                            </div>
                           <input type="hidden" id="quote" name="data[quote_id]" value=""> 
                        </div>
                        
                    </form>
                    <button type="button" class="btn btn-default" style="display: table;
                            margin: 0 auto;" id="submit">Submit</button>
                 
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</section>
<script>
		$('.reply_enquiry').click(function(){
            var qid = $(this).data('id');
           $("#quote").val(qid);
           
	     });
		$('#submit').click(function(){
           $.ajax({
	                url: "<?php echo $this->webroot;?>enquiries/ajaxMail",
	                type:'POST',
	                dataType:'json',
	                data:$("#reply_form").serialize(),
	                success: function(result){
	                    if(result.ack==1){
	                    	$("#myModal").modal('hide');
	                    	alert('Reply Male Has Been Send');
	                    }
	               }
	        }); 
	     });

</script>
  	 