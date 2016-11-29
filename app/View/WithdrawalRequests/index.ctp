<style>
.btn-primary {
            margin: 16px;
        }
pre {
    background-color: #fff;
    border: 0px solid #fff;
}

</style>
 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
<section class="login_body">

<div class="container">
  	<div class="row">
            <?php echo($this->element('leftpanel'))?>
       	<div class="col-md-10 mid-div">
          	<div class="cart-section">
                 <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal" id=" add_accreditation" name=" addAccreditation" type="submit"> Request Cash Withdrawal </button>
                  <h1>Accounting Tool</h1>
                  <p>   Your Total Fund ₦. : <?php 
                  echo $total_fund;
                  ?></p>
                  <?php 
                  if(!empty($withdrawalRequests))
                    {    ?>
                           
                      <table class="table table-bordered"> 
                        <thead > 
                        <tr> 
                        <th>Requested Withdrawal Amount</th>
                        <th>Bank Account No. </th>  
                     	<th>Status</th>
                        
                        </tr> 
                        </thead> 
                        <tbody id="table_data_user"> 
                        <tr> 
                          <?php foreach($withdrawalRequests as $value)
                                  {     ?>
                                        <td class="one"><?php echo '₦. '.$value['WithdrawalRequest']['requested_fund'];?>
                                        </td>
                                        <td class="one"><?php echo $value['WithdrawalRequest']['bank_account'];?></td>
                                        <td class="one"><?php if($value['WithdrawalRequest']['status']==0) { ?> <img style="height:30px;" src="<?php echo $this->webroot;?>img/cross-512.png"><?php } else { ?> <img style="height:30px;" src="<?php echo $this->webroot;?>img/success-01-128.png"> <?php } ?></td>

                                        </tr> 

                            <?php } ?>
                        </tbody> 
                        </table>
              <?php }
                    else
                    {
                      echo "There is no Request for Withdrawal"; 
                    }    
                    ?>
            </div>
        </div>
    </div>
</div>

<div class="container">
  <!-- <h2>Modal Example</h2> -->
  <!-- Trigger the modal with a button -->
  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
 -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Withdrawal Cash</h4>
        </div>
        <div class="modal-body">
         
          <div class="right_bar">
                    <form class="form-horizontal" id="withdrawal_form" enctype="multipart/form-data" >
                        
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Your Total Available Fund:</label>
                            <div class="col-sm-8">
                                 <?php 
                  					echo '₦. '.$total_fund;
                  				?>
                            </div>
                         
                        </div>

                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Withdrawal Amount :</label>
                            <div class="col-sm-8">
                                <input type="number" min="1" class="form-control border"  name="data[WithdrawalRequest][requested_fund]" value=" " placeholder="" >
                            </div>
                         
                        </div>

                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Bank Details:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border"  name="data[WithdrawalRequest][bank_account]" value=" " placeholder="" >
                            </div>
                         
                        </div>
                        <input type="hidden" name="data[WithdrawalRequest][total_fund]" value="<?php echo $total_fund;?>" >
                        <input type="hidden" name="data[WithdrawalRequest][user_id]" value="<?php echo $userdetails['User']['id'];?>" >                        
                        
                         <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default" id="save_details">Save Details</button>
                    </div>
                    </form>
                   
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

 
</section>
<script>
  $('#withdrawal_form').submit( function(e) {
    e.preventDefault();
    var data = new FormData(this); // <-- 'this' is your form element

    $.ajax({
            url: "<?php echo $this->webroot;?>withdrawal_requests/ajaxWithdrawalRequest",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType:'json',
            type: 'POST',     
            success: function(result){
	            if(result.ack == 1){
	              $("#myModal").modal('hide');
	              alert(result.res);
	              setTimeout(function(){ window.location.href = "<?php echo $this->webroot;?>withdrawal_requests/index"; }, 1000);
	            }
              if(result.ack == 0){
                $("#myModal").modal('hide');
                alert(result.res);
                // setTimeout(function(){ window.location.href = "<?php echo $this->webroot;?>withdrawal_requests/index"; }, 1000);
              }
          	}
    });
  });
</script>