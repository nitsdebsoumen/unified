<?php ?> 
<?php echo $this->element('user_menu'); ?>    
<section class="main_body">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php echo $this->element('user_sidebar'); ?>
            </div>
            <div class="col-md-9 whit_bg">
                <div class="right_dash_board">
                    <h1>Billing Address</h1>
                    <form class="edit_profile" method="post" action="<?php echo $this->webroot; ?>users/billing_address">
                        <input type="hidden" name="data[BillingAddress][id]" id="UserId" value="<?php echo isset($this->request->data['BillingAddress']['id'])?$this->request->data['BillingAddress']['id']:'';?>"/>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="Address">Address *</label>
                                <input type="text" name="data[BillingAddress][street_address]" id="Address" class="form-control" placeholder="Enter your Address" required="required" value="<?php echo isset($this->request->data['BillingAddress']['street_address'])?$this->request->data['BillingAddress']['street_address']:'';?>"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city">City *</label>
                                <input type="text" name="data[BillingAddress][city]" id="city" class="form-control" placeholder="Enter your city name" required="required" value="<?php echo isset($this->request->data['BillingAddress']['city'])?$this->request->data['BillingAddress']['city']:'';?>"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="state">State *</label>
                                <input type="text" name="data[BillingAddress][state]" id="state" class="form-control" placeholder="Enter your state name."  value="<?php echo isset($this->request->data['BillingAddress']['state'])?$this->request->data['BillingAddress']['state']:'';?>" required/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="country">Country *</label>
                                <input type="text" name="data[BillingAddress][country]" maxlength="200" id="country" class="form-control" placeholder="Enter your country name" value="<?php echo isset($this->request->data['BillingAddress']['country'])?$this->request->data['BillingAddress']['country']:'';?>" required="required"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="zip_code">Zipcode *</label>
                                <input type="number" name="data[BillingAddress][zip_code]" maxlength="200" id="zip_code" class="form-control" placeholder="Enter your Zipcode" value="<?php echo isset($this->request->data['BillingAddress']['zip_code'])?$this->request->data['BillingAddress']['zip_code']:'';?>" required="required"/>
                            </div>
                            <div class="form-group col-md-12">
                               <button type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

                
                
