<div class="users form">
<?php echo $this->Form->create('User',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add Venue Provider'); ?></legend>
	<?php
        
        echo $this->Form->input('first_name');
        echo $this->Form->input('last_name');
        echo $this->Form->input('email_address', array('type' => 'email'));
        echo $this->Form->input('user_pass', array('type' => 'password'));
        echo $this->Form->input('Address1');
        echo $this->Form->input('state');
        echo $this->Form->input('city');
        echo $this->Form->input('zip');
        echo $this->Form->input('country_id');
        echo $this->Form->input('Phone_number');
        //echo $this->Form->input('has_marketplace');
        echo $this->Form->input('status');
        echo $this->Form->input('featured');
        echo $this->Form->input('image',array('type'=>'file'));
        echo $this->Form->input('admin_type', array('type' => 'hidden', 'value' => 1));
	?>

    <legend><?php echo __('Add Company Details'); ?></legend>
    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>                        <div class="input text">
                            <label for="inputEmail3">Company Name:</label>
                            
                                <input name="data[CompanyDetail][company_name]" class="form-control border"  maxlength="256" type="text" id="CompanyDetailCompanyName">                            
                        </div>
                        <div class="input text">
                            <label for="inputEmail3" >Registration Number:</label>
                                <input name="data[CompanyDetail][registration_number]" class="form-control border"  maxlength="256" type="text" id="CompanyDetailRegistrationNumber">                            
                        </div>
                        <div class="input text">
                            <label for="" >Description:</label>
                            
                                <input name="data[CompanyDetail][description]" class="form-control border"  maxlength="256" type="text" id="CompanyDetailDescription">
                        </div>
                        <div class="input text">
                            <label for="" >Website Address:</label>
                                <input name="data[CompanyDetail][website_address]" class="form-control border"  maxlength="256" type="text" id="CompanyDetailWebsiteAddress">                           
                        </div>
                        <div class="input text">
                            <label for="" >Email Address:</label>
                                <input name="data[CompanyDetail][email_address]" empty="(Choose any country)" class="form-control border"  maxlength="256" type="text" id="CompanyDetailEmailAddress">                            
                        </div>
                        <div class="input text">
                            <label for="" >Telephone Number:</label>
                                <input name="data[CompanyDetail][phone_number]" empty="(Choose any state)" class="form-control border"  maxlength="256" type="text" id="CompanyDetailPhoneNumber">                            
                        </div>
                        <div class="input text">
                            <label for="" >Address:</label>
                                <input name="data[CompanyDetail][address]" class="form-control border"  maxlength="256" type="text" id="CompanyDetailAddress">
                        </div>
                        <?php
                        echo $this->Form->input('Country',array('options'=>$listCountry,'name'=>'data[CompanyDetail][country]','id'=>'CompCountry'));
                        ?>

                        <div class="input select">
                            <label for="" >State:</label>
                                <select name="data[CompanyDetail][state]"  id="CompState" >
                                    <option value="">(Choose any State)</option>
                                </select>               
                        </div>

                        <div class="input select">
                            <label for="" >City:</label>
                            
                                <select name="data[CompanyDetail][city]"  id="CompCity" >
                                    <option value="">(Choose any City)</option>
                                </select>                            
                        </div>
                        <div class="input text">
                            <label for="" >Nearest Bus Stop/Landmark:</label>
                            
                                <input name="data[CompanyDetail][landmark]" class="form-control border"  type="text" id="CompanyDetailLandmark">                            
                        </div>

                        <?php
                        echo $this->Form->input('LGA',array('options'=>$lgas,'name'=>'data[CompanyDetail][lga]','id'=>'CompanyDetailLga'));
                        ?>



                        <div class="input text">
                            <label for="" >Account Number:</label>
                            
                                <input name="data[CompanyDetail][account_number]" class="form-control border"  maxlength="256" type="text" id="CompanyDetailAccountNumber">                            
                        </div>

                        <div class="input text">
                            <label for="inputEmail3" >BVN:</label>
                            
                                <input name="data[CompanyDetail][bvn]" class="form-control border"  maxlength="255" type="text" id="CompanyDetailBvn">                            
                        </div>

                        <div class="input select">
                            <label for="" >Bank Name:</label>
                            
                                <select name="data[CompanyDetail][bank_id]"  id="CompanyDetailBankId">
<option value="">(Choose any bank)</option>
<option value="1">Access Bank Plc </option>
<option value="2">Citibank Nigeria Limited </option>
<option value="3">Diamond Bank Plc </option>
<option value="4">Ecobank Nigeria Plc </option>
<option value="5">Enterprise Bank</option>
<option value="6">Fidelity Bank Plc</option>
<option value="7">First City Monument Bank Plc</option>
<option value="8">Guaranty Trust Bank Plc</option>
<option value="9">Heritage Banking Company Ltd.</option>
<option value="10">Key Stone Bank</option>
<option value="11">MainStreet Bank </option>
<option value="12">Skye Bank Plc </option>
<option value="13">Stanbic IBTC Bank Ltd.</option>
<option value="14">Standard Chartered Bank Nigeria Ltd.</option>
<option value="15">Sterling Bank Plc</option>
<option value="16">SunTrust Bank Nigeria Limited</option>
<option value="17">Union Bank of Nigeria Plc</option>
<option value="18">United Bank For Africa Plc</option>
<option value="19">Unity Bank Plc</option>
<option value="20">Wema Bank Plc</option>
<option value="21">Zenith Bank Plc</option>
</select>                            
                        </div>
                        <div class="input text">
                            <label for="" >Branch:</label>
                            
                                <input name="data[CompanyDetail][branch]" class="form-control border"  maxlength="256" type="text" id="CompanyDetailBranch">                            
                        </div>
                        <div class="input file">
                            <label for="" >Logo:</label>
                            
                                <input type="file" name="data[CompanyDetail][logo]"  id="CompanyDetailLogo">                            
                        </div>

                        <input type="hidden" name="data[CompanyDetail][image]" value="">

    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>

<script>
$(document).ready(function(){
    $("#CompCountry").change(function(){
        var country_id = $(this).val();

        $("#CompanyDetailLga").prop("selected", false);
        if (country_id=='160')
        {
             $("#CompanyDetailLga").prop("disabled", false);
        }
        else
        {
            $("#CompanyDetailLga").prop("disabled", true);
            $("#CompanyDetailLga").val('');
        }



        $.ajax({
            url: "<?php echo $this->webroot; ?>states/ajaxStates",
            type: 'post',
            dataType: 'json',
            data: {
                c_id:country_id
            },
            success: function(result){
                if(result.ack == '1') {
                    $('#CompState').html('');
                    $('#CompState').html(result.html);
                } else {
                    $('#CompState').html(result.html);
                }
            }
        });
    });

    $("#CompState").change(function(){
        var state_id = $(this).val();
        var country_id = $("#CompCountry").val();
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
                    $('#CompCity').html(result.html);
                } else {
                    $('#CompCity').html(result.html);
                }
            }
        });
    });

});
</script>