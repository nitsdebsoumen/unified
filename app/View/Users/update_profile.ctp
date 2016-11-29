<section class="listing_result">
    <div class="container">
        <div class="row">
            <?php echo($this->element('leftpanel'))?>
            <div class="col-md-8">
                <div class="right_bar">
                    <form class="form-horizontal">
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text"><?php echo FIRST_NAME.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][first_name]" value="<?php echo $userDetails['User']['first_name']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text"><?php echo 'Surname'.':' ; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][last_name]" value="<?php echo $userDetails['User']['last_name']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Date of Birth'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][date_of_birth]" value="<?php echo $userDetails['User']['date_of_birth']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo EMAIL_ADDRESS.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][email_address]" value="<?php echo $userDetails['User']['email_address']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo PHONE.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][Phone_number]" value="<?php echo $userDetails['User']['Phone_number']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Nationality'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][nationality]" value="<?php echo $userDetails['User']['nationality']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo COUNTRY.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][country]" value="<?php echo $userDetails['Country']['name']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo STATE.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][state]" value="<?php echo $userDetails['State']['name']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo TOWN.'/'.CITY.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][city]" value="<?php echo $userDetails['City']['name']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'LGA'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][lga]" value="<?php echo $userDetails['Lga']['local_name']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Sex'.':'; ?></label>
                            <div class="col-sm-8">
                                 <input type="radio" name="data[User][sex]" value="male" <?php if($userDetails['User']['sex']==1){ echo 'checked'; } ?> disabled="" > Male<br>
                                 <input type="radio" name="data[User][sex]" value="female" <?php if($userDetails['User']['sex']==0){ echo 'checked'; } ?> disabled="" > Female<br>
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>     


                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo POST_CODE.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][zip]" value="<?php echo $userDetails['User']['zip']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo ADDRESS.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][address]" value="<?php echo $userDetails['User']['address']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
						<?php
if($userDetails['User']['admin_type']==1 || $userDetails['User']['admin_type']==2)
{

			?>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo ORGANIZATION_NAME.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][org_name]" value="<?php echo $userDetails['User']['org_name']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo JOB_TITLE.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][job_title]" value="<?php echo $userDetails['User']['job_title']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
			<?php
			}
			?>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Promotion Preferences'.':'; ?></label>
                            <div class="col-sm-8">
                                 <input type="checkbox" name="data[User][promotion_by_ladder]" value="male" <?php if($userDetails['User']['promotion_by_ladder']==1){ echo 'checked'; } ?> disabled="" >Promotions from Ladder.NG<br>
                                 <input type="checkbox" name="data[User][promotion_by_other]" value="female" <?php if($userDetails['User']['promotion_by_other']==1){ echo 'checked'; } ?> disabled="" > Promotiosn from 3rd Party<br>
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>

                        <!-- <h4><?php //echo PAY_VIA_INVOICE; ?></h4>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php //echo ACCOUNTS_CONTACT.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][account_contact]" value="<?php //echo $userDetails['User']['acc_contact']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php //echo ACCOUNTS_EMAIL.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][acc_email]" value="<?php //echo $userDetails['User']['acc_email']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php //echo ACCOUNTS_TELEPHONE.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[User][acc_tel]" value="<?php //echo $userDetails['User']['acc_tel']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div> -->

<!--                        <div class="form-group profile-field">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-default">Save Changes</button>
                                <input type="hidden" name="data[User][id]" id="" value="<?php // echo $userDetails['User']['id']; ?>" />
                            </div>
                        </div>-->
                    </form>
                    <div class="col-sm-offset-3 col-sm-9">
                    <button type="button" class="btn btn-default" id="edit">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('.edit-pro-icon > .fa.fa-pencil-square-o').click(function(){
            window.location.href = '<?php echo $this->webroot . 'users/editprofile'; ?>';
        });
        $("#edit").click(function(){
            window.location.href = '<?php echo $this->webroot . 'users/editprofile'; ?>';
        });

    });
</script>