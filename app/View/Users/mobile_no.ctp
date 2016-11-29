<section class="main_body">
    <div class="container">
        <div class="row">
                <div class="col-md-3">
                    <?php echo $this->element('user_sidebar'); ?>
                </div>
                <div class="col-md-9 whit_bg">
                    
                    <div class="right_dash_board">
                        <h1>Change Mobile no</h1>
                        <div id="cp_validation_err_msg"></div>
                        <form class="edit_profile" method="post" action=''>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="mobile_no">Enter your mobile number:</label>
                                    <input class="form-control" id="mobile_no" type="number" name="data[User][phone_no]" required="required" value="<?php echo isset($user['User']['phone_no'])?$user['User']['phone_no']:'';?>">
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-12">
                                   <button type="submit" onclick="return validate_changepassword();">Save</button>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function validate_changepassword(){
        /*var curr_pass=$('#curr_pass').val();
        var new_pass=$('#new_pass').val();
        var con_pass=$('#con_pass').val();
        if(curr_pass==''){
          $('#curr_pass').css('border','1px solid #e50516');
        }else{
          $('#curr_pass').css('border','1px solid #ccc');
        }
        if(new_pass==''){
          $('#new_pass').css('border','1px solid #e50516');
        }else{
          $('#new_pass').css('border','1px solid #ccc');
        }
        if(con_pass==''){
          $('#con_pass').css('border','1px solid #e50516');
        }else{
          $('#con_pass').css('border','1px solid #ccc');
        }
        
        if(new_pass != con_pass){
            $('#new_pass').css('border','1px solid #e50516');
            $('#con_pass').css('border','1px solid #e50516');
            $('#cp_validation_err_msg').html('<font style="color:#e50516">Password mismatch</font>');
            return false;
        }else{
            $('#cp_validation_err_msg').html('');
            return true;
        }*/
    }
</script>

