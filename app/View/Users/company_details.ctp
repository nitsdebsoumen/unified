<?php //pr($company_detail); exit;?>
<section class="listing_result">
    <div class="container">
        <div class="row">
            <?php echo($this->element('leftpanel'))?>
            <div class="col-md-8">
                <div class="right_bar">
                    <form class="form-horizontal">
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text"><?php echo 'Company Name'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][company_name]" value="<?php if(!empty($company_detail['CompanyDetail']['company_name'])) {echo $company_detail['CompanyDetail']['company_name']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text"><?php echo 'Registration Number'.':' ; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][registration_number]" value="<?php if(!empty($company_detail['CompanyDetail']['registration_number'])) { echo $company_detail['CompanyDetail']['registration_number']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <!-- <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Logo'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][ logo]" value="<?php echo $company_detail['CompanyDetail'][' logo']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div> -->
                        <div class="form-group profile-field">
                           <label for="" class="col-sm-3 right-text"><?php echo 'Logo'.':'; ?></label>
                            <div class="col-sm-8">
                        <?php if(!empty($company_detail['CompanyDetail']['logo'])) { ?>
                        <center><img src="<?php echo $this->webroot;?>/company_logo/<?php echo $company_detail['CompanyDetail']['logo']; ?>" style="width:400px"></center>
                        <?php } ?>
                             </div>
                            
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Description'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][description]" value="<?php if(!empty($company_detail['CompanyDetail']['description'])){ echo $company_detail['CompanyDetail']['description']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Website Address'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][website_address]" value="<?php if(!empty($company_detail['CompanyDetail']['website_address'])){ echo $company_detail['CompanyDetail']['website_address']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Email Address'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][email_address]" value="<?php if(!empty($company_detail['CompanyDetail']['email_address'])){ echo $company_detail['CompanyDetail']['email_address']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Telephone Number'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][phone_number]" value="<?php if(!empty($company_detail['CompanyDetail']['phone_number'])){ echo $company_detail['CompanyDetail']['phone_number']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Address'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][address]" value="<?php if(!empty($company_detail['CompanyDetail']['address'])){ echo $company_detail['CompanyDetail']['address']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'City'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][city]" value="<?php if(!empty($company_detail['City']['name'])){ echo $company_detail['City']['name']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Nearest Bus Stop/Landmark'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][nearest_bus_stop]" value="<?php if(!empty($company_detail['CompanyDetail']['nearest_bus_stop'])){ echo $company_detail['CompanyDetail']['nearest_bus_stop']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'State'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][state]" value="<?php if(!empty($company_detail['State']['name'])) { echo $company_detail['State']['name']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'LGA'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][lga]" value="<?php if(!empty($company_detail['Lga']['local_name'])){ echo $company_detail['Lga']['local_name']; }?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Country'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][country]" value="<?php if(!empty($company_detail['Country']['name'])){ echo $company_detail['Country']['name']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Account Number'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][account_number]" value="<?php if(!empty($company_detail['CompanyDetail']['account_number'])){ echo $company_detail['CompanyDetail']['account_number']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Bank Name'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][bank_id]" value="<?php if(!empty($company_detail['Bank']['bank_name'])){ echo $company_detail['Bank']['bank_name']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Branch'.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][branch]" value="<?php if(!empty($company_detail['CompanyDetail']['branch'])){ echo $company_detail['CompanyDetail']['branch']; } ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>

                        <!-- <h4><?php //echo PAY_VIA_INVOICE; ?></h4>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php //echo ACCOUNTS_CONTACT.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][account_contact]" value="<?php //echo $company_detail['CompanyDetail']['acc_contact']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php //echo ACCOUNTS_EMAIL.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][acc_email]" value="<?php //echo $company_detail['CompanyDetail']['acc_email']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php //echo ACCOUNTS_TELEPHONE.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[CompanyDetail][acc_tel]" value="<?php //echo $company_detail['CompanyDetail']['acc_tel']; ?>" placeholder="" disabled="">
                            </div>
                            <div class="col-sm-1 edit-pro-icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                        </div> -->

<!--                        <div class="form-group profile-field">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-default">Save Changes</button>
                                <input type="hidden" name="data[CompanyDetail][id]" id="" value="<?php // echo $company_detail['CompanyDetail']['id']; ?>" />
                            </div>
                        </div>-->
                    </form>
                    <center><button type="button" class="btn btn-warning" id="edit">Edit</button></center>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
        $('.edit-pro-icon > .fa.fa-pencil-square-o').click(function(){
            window.location.href = '<?php echo $this->webroot . 'users/edit_company_details'; ?>';
        });
         $("#edit").click(function(){
            window.location.href = '<?php echo $this->webroot . 'users/edit_company_details'; ?>';
        });
    });
</script>