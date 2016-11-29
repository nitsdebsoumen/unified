<?php
//pr($userDetails);
?>
<section class="listing_result">
    <div class="container">
        <div class="row">
            <?php echo($this->element('leftpanel'))?>
            <div class="col-md-8">
                <div class="right_bar">
                    <?php
                    echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal'));
                    ?>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text"><?php echo FIRST_NAME.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'first_name',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text"><?php echo 'Surname'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'last_name',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>
                         <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text"><?php echo 'Date of Dirth'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'date_of_birth',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'id'=>'date_of_birth',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Email Address'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'email_address',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required',
                                        'disabled' => 'disabled'
                                    )
                                );
                                ?>
                            </div>
                        </div> 
                        <input name="data[User][email_address]" class="form-control border" required="required" type='hidden' value="<?php echo $userDetails['User']['email_address']; ?>" >
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo PHONE.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'Phone_number',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Nationality'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'nationality',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo COUNTRY.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'country',
                                    array(
                                        'empty' => '(Choose any country)',
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo STATE.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'state',
                                    array(
                                        'empty' => '(Choose any state)',
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo TOWN.'/'.CITY.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'city',
                                    array(
                                        'empty' => '(Choose any city)',
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'LGA'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'lga',
                                    array(
                                        'empty' => '(Choose any LGA)',
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'disabled' => 'disabled'
                                    )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo POST_CODE.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'zip',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Sex'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                              $options = array('1' => 'Male', '0' => 'Female');
                                $attributes = array('legend' => false);
                                echo $this->Form->radio('sex', $options, $attributes);
                                ?>
                            </div>
                        </div>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo ADDRESS.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'address',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>
						<?php
if($userDetails['User']['admin_type']==1 || $userDetails['User']['admin_type']==2)
{

			?>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo ORGANIZATION_NAME.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'org_name',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo JOB_TITLE.':';?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'job_title',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>
<?php
}
?>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text">Promotion Preferences:</label>
                            <div class="col-sm-8">
                                 <input type="checkbox" name="data[User][promotion_by_ladder]" value="1" <?php if($userDetails['User']['promotion_by_ladder']==1){ echo 'checked'; } ?> >Promotions from Ladder.NG<br>
                                 <input type="checkbox" name="data[User][promotion_by_other]" value="1" <?php if($userDetails['User']['promotion_by_other']==1){ echo 'checked'; } ?> > Promotiosn from 3rd Party<br>
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                               
                            </div>
                        </div>
			<?php
if($userDetails['User']['admin_type']==1 || $userDetails['User']['admin_type']==2)
{

			?>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Logo'.':';?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'user_logo',
                                    array(
                                        'label' => FALSE,
                                        'type'=>'file',
                                        'class' => 'form-control border',
                                        'div' => FALSE
                                    )
                                );
                                ?>
                            </div>
                        </div>
			<?php
			}
			?>

                         <input type="hidden" name="data[User][image]" value="<?php if(!empty($userDetails['User']['user_logo'])){ echo $userDetails['User']['user_logo']; }?>">

                        <!-- <h4><?php echo PAY_VIA_INVOICE; ?></h4>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo ACCOUNTS_CONTACT; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'acc_contact',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><? echo ACCOUNTS_EMAIL.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'acc_email',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo ACCOUNTS_TELEPHONE.':' ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'acc_tel',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div> -->

                        <div class="form-group profile-field">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-default"><?php echo SAVE_CHANGES; ?></button>
                                <?php
                                echo $this->Form->input('id');
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="div1"></div>
</section>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#date_of_birth" ).datepicker({
         changeMonth: true,
         changeYear: true,
         yearRange: '1900:+150'
    });
  } );
  </script>
<script>
$(document).ready(function(){
    $("#UserCountry").change(function(){
        var country_id = $(this).val();
        $.ajax({
            url: "<?php echo $this->webroot; ?>states/ajaxStates",
            type: 'post',
            dataType: 'json',
            data: {
                c_id:country_id
            },
            success: function(result){
                if(result.ack == '1') {
                    $('#UserState').html(result.html);
                } else {
                    $('#UserState').html(result.html);
                }
            }
        });
    });

    $("#UserState").change(function(){
        var state_id = $(this).val();
        var country_id = $("#UserCountry").val();
        $.ajax({
            url: "<?php echo $this->webroot; ?>cities/ajaxCities",
            type: 'post',
            dataType: 'json',
            data: {
                s_id:state_id,
                c_id:country_id
            },
            success: function(result){
                if(result.ack == '1') {
                    $('#UserCity').html(result.html);
                } else {
                    $('#UserCity').html(result.html);
                }
            }
        });
    });
    $("#UserCountry").change(function(){
        var country_id = $("#UserCountry").val();
        if(country_id==160)
        {
            $("#UserLga").prop('disabled', false);
        }
        else
        {
           $("#UserLga").prop('disabled', true);
           $("#UserLga").val(''); 
        }
    });
    $(document).ready(function(){
        var country_id = $("#UserCountry").val();
        if(country_id==160)
        {
            console.log('Hiiii');
            $("#UserLga").prop('disabled', false);
        }
        else
        {
           $("#UserLga").prop('disabled', true);
           $("#UserLga").val(''); 
        }
    });

});
</script>
