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
                        <input type="hidden"name="data[Venue][user_id]" value="<?php echo $user_id; ?>" >
                        <div id="container"></div>
                        <div id="propertylistingmoreimage"></div>
                        <button id="somebutton" type="button">Add Image</button>                       
                        

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

<script>
var c = 1;
$("#somebutton").click(function () {
    
    if(c<13){
        $("#propertylistingmoreimage").append('<input type="file" name="data[Venue][image][]" >');
    }
  c = c+1;      
});
</script>