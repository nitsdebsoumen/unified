<style>
    .checkbox input[type="checkbox"] { margin: 0; }
    .checkbox { border: medium none !important; }
</style>
<section class="listing_result">
    <div class="container">
        <div class="row">
            <?php echo($this->element('leftpanel'))?>
            <div class="col-md-8">
                <div class="right_bar">
                    <?php
                    echo $this->Form->create('Venue', array('type' => 'file', 'class' => 'form-horizontal'));
                    ?>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Venue Name:</label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'venue_name',
                                    array(
                                        'empty' => '(Give Venue Name)',
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
                            <label for="inputEmail3" class="col-sm-3 right-text">Description:</label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'description',
                                    array(
                                        'empty' => '(Give Description)',
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
                            <label for="" class="col-sm-3 right-text">Size:</label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'size',
                                    array(
                                        'empty' => '(Enter Size)',
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
                            <label for="" class="col-sm-3 right-text">Address:</label>
                            <div class="col-sm-9">
                                <input name="data[Venue][address]" empty="(Enter Address)" class="form-control border" required="required" maxlength="256" type="text" id="VenueAddress">
                            </div>
                        </div>        

                        <div class="form-group profile-field">
                          <label for="" class="col-sm-3 right-text">Type of Events:</label>
                           <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'Event', array(
                                'label' => FALSE,
                                'type' => 'select',
                                'multiple' => 'checkbox',
                                'options' => $events
                                    )
                            );
                            ?>
                           </div>
                        </div>
                         <div class="form-group profile-field">
                          <label for="" class="col-sm-3 right-text">Facilities:</label>
                           <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'Facility', array(
                                'label' => FALSE,
                                'type' => 'select',
                                'multiple' => 'checkbox',
                                'options' => $facilities
                                    )
                            );
                            ?>
                           </div>
                        </div>

                      <!--   <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text">Types of events:</label>
                            <div class="col-sm-9">
                                <?php

                                echo $this->Form->select(
                                    'event_id',
                                    $event
                                    );

                                ?>
                            </div>
                        </div> -->

                      <?php

                      $policy=array('1'=>'Per hour','2'=>'Per day');

                      ?>


                      <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text">Policy type:</label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'policy_type',
                                    array(
                                        'empty' => '(Select policy type)',
                                        'label' => FALSE,
                                        'options'=>$policy,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>


                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text">Price:</label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'price',
                                    array(
                                        'empty' => '(Give Price)',
                                        'label' => FALSE,
                                        'class' => 'form-control border',
                                        'div' => FALSE,
                                        'required' => 'required'
                                    )
                                );
                                ?>
                            </div>
                        </div>



                        <!-- <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text">Courses:</label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->select('post_id',$course);
                                ?>
                            </div>
                        </div> -->
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text">Sort of Details:</label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input(
                                    'sort_of_details',
                                    array(
                                        'empty' => '(Give a Sort Details )',
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
                        <label for="" class="col-sm-3 right-text">Image:</label>
                        <div class="col-sm-9">
                             <input type="hidden"name="data[Venue][user_id]" value="<?php echo $user_id; ?>" >
                             <div id="container"></div>
                             <div id="propertylistingmoreimage"></div>
                            <button id="somebutton" class="btn btn-default" style="font-size: 13px;" type="button">Add Image</button>
                        </div>
                    </div>


                        <div class="form-group profile-field">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-default">Add Venue</button>
                                <?php
                               // echo $this->Form->input('id');
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&language=en-AU"></script>
<script>
var c = 1;
$("#somebutton").click(function () {

    if(c<13){
        $("#propertylistingmoreimage").append('<input type="file" class="form-control" name="data[Venue][image][]" >');
    }
  c = c+1;
});

 var autocomplete = new google.maps.places.Autocomplete($("#VenueAddress")[0], {});

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                console.log(place.address_components);
            });
</script>