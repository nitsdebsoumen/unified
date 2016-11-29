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
                    echo $this->Form->create('CompanyDetail', array('type' => 'file', 'class' => 'form-horizontal'));
                    ?>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text"><?php echo 'Company Name'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'company_name',
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
                            <label for="inputEmail3" class="col-sm-3 right-text"><?php echo 'Registration Number'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'registration_number',
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
                            <label for="" class="col-sm-3 right-text"><?php echo 'Description'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'description',
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
                            <label for="" class="col-sm-3 right-text"><?php echo 'Website Address'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'website_address',
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
                            <label for="" class="col-sm-3 right-text"><?php echo 'Email Address'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'email_address',
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
                            <label for="" class="col-sm-3 right-text"><?php echo 'Telephone Number'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'phone_number',
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
                            <label for="" class="col-sm-3 right-text"><?php echo 'Address'.':'; ?></label>
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

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Country'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'country',
                                    array(
                                        'option' => $countries,
                                        'empty' => '(Choose any country)',
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'id' => 'UserCountry',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'State'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'state',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'id' => 'UserState',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>

                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'City'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'city',
                                    array(
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'id' =>'UserCity',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'LGA'.':';?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'lga',
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
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo 'Nearest Bus Stop/Landmark'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'landmark',
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
                            <label for="" class="col-sm-3 right-text"><?php echo 'Account Number'.':'; ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'account_number',
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
                            <label for="" class="col-sm-3 right-text"><?php echo 'Bank Name'.':' ?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'bank_name',
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
                            <label for="" class="col-sm-3 right-text"><?php echo 'Branch'.':';?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'branch',
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
                            <label for="" class="col-sm-3 right-text"><?php echo 'Logo'.':';?></label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'logo',
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

                        <input type="hidden" name="data[CompanyDetail][image]" value="<?php if(!empty($CompanyDetail['CompanyDetail']['logo'])){ echo $CompanyDetail['CompanyDetail']['logo']; }?>">

                        <input type="hidden" name="data[CompanyDetail][user_id]" value="<?php echo $userid;?>">
                        <input type="hidden" name="data[CompanyDetail][id]" value="<?php if(!empty($CompanyDetail['CompanyDetail']['id'])){ echo $CompanyDetail['CompanyDetail']['id']; }?>">

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
                    $('#UserState').html('');
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
            $("#CompanyDetailLga").prop('disabled', false);
        }
        else
        {
           $("#CompanyDetailLga").prop('disabled', true);
           $("#CompanyDetailLga").val(''); 
        }
    });

});
</script>