<?php
//pr($userpopdetails);
//pr($countries);
$userid = $this->Session->read('user_id');
//echo $userpopdetails['User']['id']; 	
?>
<link href="<?php echo $this->webroot;?>css/lc_switch.css" rel="stylesheet" type="text/css">
<section class="inner-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-sm-8 middle-div">
					<form name="" method="post" action="" enctype="multipart/form-data">
						  <input type="hidden" value="<?php if(isset($userpopdetails['User']['city']) && $userpopdetails['User']['city']!='') { echo $userpopdetails['User']['city'];}?>" name="data[User][city]" id="postCity1">
                                <input type="hidden" value="<?php if(isset($userpopdetails['User']['state']) && $userpopdetails['User']['state']!='') { echo $userpopdetails['User']['state'];}?>" name="data[User][state]" id="postState1">
                                <input type="hidden" value="<?php if(isset($userpopdetails['User']['address']) && $userpopdetails['User']['address']!='') { echo $userpopdetails['User']['address'];}?>" name="data[User][address]" id="postAddress1">
                                <input type="hidden" value="<?php if(isset($userpopdetails['User']['country']) && $userpopdetails['User']['country']!='') { echo $userpopdetails['User']['country'];}?>" name="data[User][country]" id="postCountry1">
                                <input type="hidden" value="<?php if(isset($userpopdetails['User']['zip_code']) && $userpopdetails['User']['zip_code']!='') { echo $userpopdetails['User']['zip_code'];}?>" name="data[User][zip_code]" id="postZip_code1">
					<div class="row text-center">
						<div class="col-md-12">
							<div class="edit-profile-round-img-hold">
								<?php if($userpopdetails['UserImage'][0]['originalpath']!='') {?><img src="<?php echo $this->webroot;?>user_images/<?php echo $userpopdetails['UserImage'][0]['originalpath'];?>" alt="" id="preview"><?php } else {?><img src="<?php echo $this->webroot;?>user_images/default.png" alt="" id="preview"><?php } ?>
								

								<a href="javascript:void();" class="choose_file"><input type="file" name="data[UserImage][originalpath]" id="UserProfileImg" class="form-control" onChange="readURL(this)"/>Change</a>

								

							</div>

							<input type="hidden" name="data[UserImage][hid_img]" value="<?php echo $userpopdetails['UserImage'][0]['originalpath'];?>" >
							<p class="addl-info">Click the photo to change it<br> Your photo must be in PNG or JPEG format and under 5mb</p>
						</div>
					</div>
					<h4 style="border-bottom:1px solid #ccc; padding-bottom: 5px">Settings</h4>
					<div class="edit-profile-wrapper">
						
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>First Name</label>
										<div class="icon-input-holder">
											<span class="icon"><img src="<?php echo $this->webroot;?>images/usr-icon.png" alt=""></span>
											<input type="text" name="data[User][first_name]" placeholder="First name" value="<?php if(isset($userpopdetails['User']['first_name']) && $userpopdetails['User']['first_name']!='') { echo $userpopdetails['User']['first_name'];}?>" required/>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" name="data[User][last_name]" class="form-control" placeholder="Last name"  value="<?php if(isset($userpopdetails['User']['last_name']) && $userpopdetails['User']['last_name']!='') { echo $userpopdetails['User']['last_name'];}?>" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Email</label>
								<div class="icon-input-holder">
									<span class="icon"><img src="<?php echo $this->webroot;?>images/mail.png" alt=""></span>
									<input type="text" name="data[User][email_address]" placeholder="Email" value="<?php if(isset($userpopdetails['User']['email_address']) && $userpopdetails['User']['email_address']!='') { echo $userpopdetails['User']['email_address'];}?>" required />
								</div>
							</div>

							<div class="form-group">
								<label>Location</label>
								<div class="icon-input-holder">
									<span class="icon"><img src="<?php echo $this->webroot;?>images/loctn-small.png" alt=""></span>
									<input type="text" name="data[User][location]" id="postLocation1" placeholder="Location" value="<?php if(isset($userpopdetails['User']['location']) && $userpopdetails['User']['location']!='') { echo $userpopdetails['User']['location'];}?>" required  onFocus="geolocate1()" style="width: 100%;"/>
								</div>
							</div>

							<!--<div class="form-group">
								<label>Country</label>
								<div class="icon-input-holder">
									<span class="icon"><img src="<?php echo $this->webroot;?>images/loctn-small.png" alt=""></span>
									<select class="form-control" name="data[User][country_id]" required>
										<?php
										foreach($countries as $country)
										{
										?>
										<option value="<?php echo $country['Country']['id']?>" <?php if($country['Country']['id']==$userpopdetails['User']['country_id']) {?>selected<?php } ?>><?php echo $country['Country']['name']?></option>
										<?php
									}
										?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label>State</label>
								<div class="icon-input-holder">
									<span class="icon"><img src="<?php echo $this->webroot;?>images/loctn-small.png" alt=""></span>
									<input type="text" name="data[User][state]" placeholder="State" value="<?php if(isset($userpopdetails['User']['state']) && $userpopdetails['User']['state']!='') { echo $userpopdetails['User']['state'];}?>" required/>
								</div>
							</div>

							<div class="form-group">
								<label>City</label>
								<div class="icon-input-holder">
									<span class="icon"><img src="<?php echo $this->webroot;?>images/loctn-small.png" alt=""></span>
									<input type="text" name="data[User][city]" placeholder="City" value="<?php if(isset($userpopdetails['User']['city']) && $userpopdetails['User']['city']!='') { echo $userpopdetails['User']['city'];}?>" required />
								</div>
							</div>

							<div class="form-group">
								<label>Zipcode</label>
								<div class="icon-input-holder">
									<span class="icon"><img src="<?php echo $this->webroot;?>images/loctn-small.png" alt=""></span>
									<input type="text" name="data[User][zip]" placeholder="Zipcode" value="<?php if(isset($userpopdetails['User']['zip']) && $userpopdetails['User']['zip']!='') { echo $userpopdetails['User']['zip'];}?>" required />
								</div>
							</div>-->

							<div class="form-group">
								<label>Password</label>
								<div class="icon-input-holder">
									<span class="icon"><img src="<?php echo $this->webroot;?>images/security-check.png" alt=""></span>
									<input type="password" name="data[User][user_pass]" placeholder="Password" />
									<input type="hidden" name="data[User][hid_pass]" value="<?php echo $userpopdetails['User']['user_pass'];?>" />
								</div>
							</div>
							<div class="form-group">
								<label>Verification Process</label>
								
							</div>
							<div class="form-group">
								<label>News Letter</label>
								<p><input type="checkbox" name="data[User][is_newsletter]" value="1" class="lcs_check lcs_tt1" <?php if($userpopdetails['User']['is_newsletter']==1) {?>checked="checked" <?php } ?>autocomplete="off"/></p>
							</div>
							<div class="form-group">
								
								<input type="submit" class="btn btn-primary btn-block btn-lg" value="Submit"/>
								
							</div>
							<div class="form-group">
								<a href="<?php echo $this->webroot;?>users/userlogout" class="btn-block text-center">Log Out</a>
							</div>
						
					</div>
					</form>
				</div>
			</div>
		</div>
	</section>



	  <script src="<?php echo $this->webroot;?>js/lc_switch.js"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
		$('input').lc_switch();

		// triggered each time a field changes status
		$('body').delegate('.lcs_check', 'lcs-statuschange', function() {
			var status = ($(this).is(':checked')) ? 'checked' : 'unchecked';
			console.log('field changed status: '+ status );
		});
		
		
		// triggered each time a field is checked
		$('body').delegate('.lcs_check', 'lcs-on', function() {
			console.log('field is checked');
		});
		
		
		// triggered each time a is unchecked
		$('body').delegate('.lcs_check', 'lcs-off', function() {
			console.log('field is unchecked');
		});
	});
	</script>

	<style>
 .choose_file{
    position:relative;
    display:inline-block; 
    /*border:#cccccc solid 1px;*/
    padding: 5px 6px 5px 8px;
    font: normal 14px Myriad Pro, Verdana, Geneva, sans-serif;
    color: #7f7f7f;
    margin-top: 2px;
    /*background:white;*/
    width: 100%;
}
.choose_file input[type="file"]{
    -webkit-appearance:none; 
    position:absolute;
    top:0; left:0;
    opacity:0; 
} 
.profile_image_holder img
{
 height:218px!important;    
}
</style>

<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#preview').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>

<script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var CustomcomponentForm = {
        postAddress1: 'short_name',
        //route: 'long_name',
        postCity1: 'long_name',
        postState1: 'short_name',
        postCountry1: 'long_name',
        postZip_code1: 'short_name'
      };
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete1() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('postLocation1')),
            {types: ['geocode']});
console.log('Hi');
        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress1);
      }

      function fillInAddress1() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
console.log('Hi2');
        for (var component in CustomcomponentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
          alert(document.getElementById('postZip_code').value);
            var val = place.address_components[i][componentForm[addressType]];
            //alert(addressType);
            if(addressType=='street_number'){
                document.getElementById('postAddress1').value = val;
            }
            else if(addressType=='route'){
                document.getElementById('postAddress1').value = document.getElementById('postAddress1').value+val;
            }
            else if(addressType=='locality'){
                document.getElementById('postCity1').value = val;
            }
            else if(addressType=='administrative_area_level_1'){
                document.getElementById('postState1').value = val;
            }
            else if(addressType=='country'){
                document.getElementById('postCountry1').value = val;
            }
            else if(addressType=='postal_code'){
                document.getElementById('postZip_code1').value = val;
            }
            
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate1() {
//console.log('Hi0');         
          initAutocomplete1();
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
</script>


</script>