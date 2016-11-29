<?php
$FacebookVerify=isset($UserDetails['User']['fb_verification'])?$UserDetails['User']['fb_verification']:'';
$TwitterVerify=isset($UserDetails['User']['tw_verification'])?$UserDetails['User']['tw_verification']:'';
$LinkedinVerify=isset($UserDetails['User']['lin_verification'])?$UserDetails['User']['lin_verification']:'';
$EmailVerify=isset($UserDetails['User']['is_email'])?$UserDetails['User']['is_email']:'';
?>

<script type="text/javascript">
// facebook verification    
$.ajaxSetup({ cache: true });
$.getScript('//connect.facebook.net/en_US/all.js', function(){
    FB.init({ appId: '1509350872727862'});  		
    $(".flogin").on("click", function(e){
        e.preventDefault();				
        FB.login(function(response){
                // FB Login Failed //
                if(!response || response.status !== 'connected') {
                        alert("Given account information are not authorised", "Facebook says");
                }else{
                    // FB Login Successfull //
                    FB.api('/me', {fields: 'id,name,email'}, function(fbdata){						
                            console.log(fbdata); //
                            var fb_user_id = fbdata.id;	
                            
                            $.post('<?php echo($this->webroot);?>users/social_verification/facebook/'+fb_user_id,function(data){
                                //alert(data);
                                   if(data!=''){
                                       window.location.href="<?php echo($this->webroot)?>users/verification";
                                    } 
                             });
                    })
                }
        }, {scope:"email"});
    });
});

// delete social link
$(document).ready(function(){       
    $( ".DeleteVerification" ).click(function() {
        var DataType=$(this).attr('id');
        $('#VerificationType').val(DataType);
        $('#DeleteModal').modal({backdrop: 'static', keyboard: false}); 
        /*var currenturl = $(location).attr('href');
        if(DataType!=''){
            $.post('<?php echo($this->webroot);?>users/social_verification_delete/'+DataType,function(data){
                if(data!=''){
                    window.location = currenturl;
                } 
            });
        }else{
            window.location = currenturl;
        }*/


    });
});
</script>


<script type="text/javascript">
    
    // Setup an event listener to make an API call once auth is complete
    function onLinkedInLoad() {
        $('a[id*=li_ui_li_gen_]').html('<span class="social_text">Add Linkedin </span>');
        IN.Event.on(IN, "auth", getProfileData);
    }

    // Handle the successful return from the API call
    function onSuccess(data) {
        //console.log(data);
        var ln_user_id = data.id;
        if(ln_user_id!=''){
            $.post('<?php echo($this->webroot);?>users/social_verification/linkedin/'+ln_user_id,function(response_data){
                if(response_data!=''){
                    window.location.href="<?php echo($this->webroot)?>users/verification";
                } 
            });
        }
    }

    // Handle an error response from the API call
    function onError(error) {
        //console.log(error);
        $('#errMsg').html('');
        $('#errMsg').html('<div class="col-md-12"><div class="alert alert-danger"><strong>Error!</strong>'+error+'</div></div>');
    }

    // Use the API call wrapper to request the member's basic profile data
    function getProfileData() {
        //IN.API.Raw("/people/~").result(onSuccess).error(onError);
        IN.API.Profile("me").fields("id","first-name", "last-name", "email-address").result(onSuccess).error(onError);

    }

</script>

<?php echo $this->element('user_menu'); ?>
<section class="main_body">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php echo $this->element('user_sidebar'); ?>
            </div>
            <div class="col-md-9">
                <div class="whit_bg">
                <div class="row" id="errMsg"></div>
                <div class="right_dash_board">
                    <h1>Email Verifications</h1>
                           <div class="row">
                            <?php if($EmailVerify==0){?>
                            <form class="edit_profile" method="post" action="">   
                            <div class="form-group col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="email_verification">Enter email</label>
                                    <input class="form-control" id="email_verification" type="email" name="email_verification" required="required" placeholder="Enter email">
                                </div>
                                <div class="form-group col-md-6"><label for="">&nbsp;</label><button type="submit">Save</button></div>
                            </div>
                            <div class="clearfix"></div>
                            </form>
                            <?php 
                            }else{
                                echo'<div class="form-group col-md-12">&nbsp;</div><div class="form-group col-md-12"><span>Email Verified </span> <a class="DeleteVerification" id="EmailDelete" href="Javascript: void(0);"> Remove</a></div>';
                            }
                            ?>
                        </div>
                    <h1>Social Verifications</h1>
                    <p style="padding-top:10px;">You can add verifications to your account here to improve your public profile</p>
                           <div class="row">
                            <div class="form-group col-md-12"></div>   
                            <div class="form-group col-md-12">
                                <span class="fa fa-facebook follow_one" style="background:#153892"></span> <?php if($FacebookVerify!=''){ echo '<span class="social_text">Facebook Connected </span> <a class="DeleteVerification" id="FacebookDelete" href="Javascript: void(0);"> Remove</a>';}else{ echo '<a class="flogin" href="Javascript: void(0);"> <span class="social_text">Add Facebook</span></a>';}?>
                            </div>
                            <div class="form-group col-md-12">
                                <span class="fa fa-twitter follow_one" style="background:#00BCEC"></span> <?php if($TwitterVerify!=''){ echo '<span class="social_text">Twitter Connected </span> <a class="DeleteVerification" id="TwitterDelete" href="Javascript: void(0);"> Remove</a>';}else{ echo '<a class="" href="'.$this->webroot.'users/twitter_verification"> <span class="social_text">Add Twitter</span></a>';}?>
                            </div>
                            <div class="form-group col-md-12">
                                <span class="fa fa-linkedin follow_one" style="background:#4875B4"></span> <?php if($LinkedinVerify!=''){ echo '<span class="social_text">Linkedin Connected </span> <a class="DeleteVerification" id="LinkedinDelete" href="Javascript: void(0);"> Remove</a>';}else{ echo '<a class="" href="Javascript: void(0);"></a><script type="in/Login"></script>';}?> 
                            </div><!-- -->
                            
                            <div class="clearfix"></div>
                        </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form action="<?php echo $this->webroot?>users/social_verification_delete" method="post" >
      <input type="hidden" name="VerificationType" id="VerificationType" value="">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="myModalLabel">Remove verification</h4>
               </div>
               <div class="modal-body">
                  <div class="forms">
                      <div class="form-group">
                          <div class="col-md-3"><i class="fa red fa-2x fa-exclamation"></i></div>
                          <div class="col-md-8"><p>Are you sure you want to remove this verification?
                                  This will remove the badge on your profile</p></div>
                      </div>

                  </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-warning close pull-left" data-dismiss="modal" aria-label="Close">Cancel</button> &nbsp; <button type="submit" name="report_submit" class="btn btn-default">Continue</button>
               </div>
          </div>
        </div>
    </form>
</div>

<style>
.follow_one{
    border-radius: 100%;
    color: #fff;
    float: left;
    font-size: 24px;
    height: 40px;
    line-height: 39px;
    margin-right: 10px;
    text-align: center;
    text-decoration: none;
    width: 40px;
}
.social_text{
    font-size: 16px;
    text-decoration: none;
    line-height: 2;
}
</style>
