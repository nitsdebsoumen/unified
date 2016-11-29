<?php echo $this->element('user_menu'); ?>
<section class="main_body">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php echo $this->element('user_sidebar'); ?>
            </div>
            <div class="col-md-9">
            <div class="col-md-12 whit_bg">
                <div class="right_dash_board" style="width:100%!important;">
                    
                    <h1>Edit Paypal Email</h1>
                    <form class="edit_profile" action="<?php echo $this->webroot; ?>users/billing" method="post" >
                        <input type="hidden" name="data[User][id]" id="UserId" value="<?php echo($this->request->data['User']['id']);?>"/>
                        <div class="row">
                            
                            <div class="form-group col-md-6">
                                <label for="paypal_email">Paypal Email *</label>
                                <input type="email" value="<?php echo($this->request->data['User']['paypal_email']);?>" name="data[User][paypal_email]" required="required" class="form-control" id="paypal_email" placeholder="Paypal Email">
                            </div>
                            <div class="form-group col-md-6">
                                <p>Don't have a PayPal email setup easily by clicking <a href="https://www.paypal.com" target="_blank">link</a> </p>
                                <p><img src="<?php echo $this->webroot;?>images/PayPal_logo.png" alt="" style="height: 42px; width:auto; padding-top: 5px; border-radius: 9px;"></p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-md-12">
                               <button type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

             <div class="col-md-12 whit_bg">
                <div class="right_dash_board" style="width:100%!important;">
                    <h1>Billing Address</h1>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="autocomplete_address">Enter your address</label>
                            <input id="autocomplete_address" placeholder="Enter your address" class="form-control" onFocus="geolocate()" type="text">
                        </div>
                    </div>
                    <form class="edit_profile" method="post" action="<?php echo $this->webroot; ?>users/billing_address">
                        <input type="hidden" name="data[BillingAddress][id]" id="UserId" value="<?php echo isset($UserBillingAddress['BillingAddress']['id'])?$UserBillingAddress['BillingAddress']['id']:'';?>"/>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="Address">Street Address *</label>
                                <input type="text" name="data[BillingAddress][street_address]" id="Address" class="form-control" placeholder="Enter your Street Address" required="required" value="<?php echo isset($UserBillingAddress['BillingAddress']['street_address'])?$UserBillingAddress['BillingAddress']['street_address']:'';?>"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city">City *</label>
                                <input type="text" name="data[BillingAddress][city]" id="city" class="form-control" placeholder="Enter your city name" required="required" value="<?php echo isset($UserBillingAddress['BillingAddress']['city'])?$UserBillingAddress['BillingAddress']['city']:'';?>"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="state">State *</label>
                                <input type="text" name="data[BillingAddress][state]" id="state" class="form-control" placeholder="Enter your state name."  value="<?php echo isset($UserBillingAddress['BillingAddress']['state'])?$UserBillingAddress['BillingAddress']['state']:'';?>" required/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="country">Country *</label>
                                <input type="text" name="data[BillingAddress][country]" maxlength="200" id="country" class="form-control" placeholder="Enter your country name" value="<?php echo isset($UserBillingAddress['BillingAddress']['country'])?$UserBillingAddress['BillingAddress']['country']:'';?>" required="required"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="zip_code">Zipcode *</label>
                                <input type="text" name="data[BillingAddress][zip_code]" maxlength="200" id="zip_code" class="form-control" placeholder="Enter your Zipcode" value="<?php echo isset($UserBillingAddress['BillingAddress']['zip_code'])?$UserBillingAddress['BillingAddress']['zip_code']:'';?>" required="required"/>
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
    </div>
</section>

<script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var CustomcomponentForm = {
        Address: 'short_name',
        //route: 'long_name',
        city: 'long_name',
        state: 'short_name',
        country: 'long_name',
        zip_code: 'short_name'
      };
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete_address')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in CustomcomponentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            //alert(addressType);
            if(addressType=='street_number'){
                document.getElementById('Address').value = val;
            }else if(addressType=='route'){
                document.getElementById('Address').value = document.getElementById('Address').value+val;
            }else if(addressType=='locality'){
                document.getElementById('city').value = val;
            }else if(addressType=='administrative_area_level_1'){
                document.getElementById('state').value = val;
            }else if(addressType=='country'){
                document.getElementById('country').value = val;
            }else if(addressType=='postal_code'){
                document.getElementById('zip_code').value = val;
            }
            
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
          initAutocomplete();
        /*if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }*/
      }
</script>