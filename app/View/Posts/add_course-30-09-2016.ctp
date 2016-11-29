<style>
    .checkbox input[type="checkbox"] { margin: 0; }
    .checkbox { border: medium none !important; }
</style>
<section class="listing_result">
    <div class="container">
        <div class="row">
            <?php echo($this->element('leftpanel')) ?>
            <div class="col-md-8">
                <div class="right_bar">
                    <h4>Add Course/Training</h4>
                    <?php
                    echo $this->Form->create('Post', array('type' => 'file', 'class' => 'form-horizontal'));
                    ?>

                    <div class="form-group profile-field">
                        <label for="" class="col-sm-3 right-text">Title:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'post_title', array(
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
                        <label for="" class="col-sm-3 right-text">Description:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'post_description', array(
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
                        <label for="" class="col-sm-3 right-text">Short Summary:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'short_summary', array(
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
                        <label for="" class="col-sm-3 right-text">Maximum Number:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                'quantity', array(
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
                        <label for="" class="col-sm-3 right-text">Who Should Attend:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                'who_should_attend', array(
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
                        <label for="" class="col-sm-3 right-text">Keywords:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                'Keyword', array(
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
                        <label for="" class="col-sm-3 right-text">Price:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'price', array(
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
                        <label for="" class="col-sm-3 right-text">Category:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'category_id', array(
                                'empty' => '(choose any category)',
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
                        <label for="" class="col-sm-3 right-text">Delivery:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input('type_of_course', array(
                                    'label'=>FALSE,
                                    'class'=>'form-control border',
                                    'options' => array('Classroom','Online'),
                                    'empty' => '(choose one)',
                                    'div' => FALSE,
                                    'required' => 'required'
                                ));  
                            ?>
                        </div>
                    </div>
                    <div class="form-group profile-field">
                        <label for="" class="col-sm-3 right-text">Location:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'location', array(
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
                        <label for="" class="col-sm-3 right-text">Skills:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'Skill', array(
                                'label' => FALSE,
                                'type' => 'select',
                                'multiple' => 'checkbox',
                                'options' => $skills
                                    )
                            );
                            ?>
                        </div>
                    </div>  -->
                    <div class="form-group profile-field">
                        <label for="" class="col-sm-3 right-text">Start Date:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'startdate', array(
                                'label' => FALSE,
                                'type' => 'text',
                                'class' => 'form-control border',
                                'required' => 'required'
                                    )
                            );
                            ?>
                        </div>
                    </div>
                    <div class="form-group profile-field">
                        <label for="" class="col-sm-3 right-text">End Date:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'enddate', array(
                                'label' => FALSE,
                                'type' => 'text',
                                'class' => 'form-control border',
                                'required' => 'required'
                                    )
                            );
                            ?>
                        </div>
                    </div>
                    <div class="form-group profile-field">
                        <label for="" class="col-sm-3 right-text">Status:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input('type_of_course', array(
                                    'label'=>FALSE,
                                    'class'=>'form-control border',
                                    'options' => array('1'=>'Draft','2'=>'Active','3'=>'Inactive'),
                                    'empty' => '(choose one)',
                                    'div' => FALSE,
                                    'required' => 'required'
                                ));  
                            ?>
                        </div>
                    </div>
                    <div class="form-group profile-field">
                        <label for="" class="col-sm-3 right-text">Duration:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'course_duration', array(
                                'label' => FALSE,
                                'class' => 'form-control border',
                                'required' => 'required'
                                    )
                            );
                            ?>
                        </div>
                    </div>

                    <div class="form-group profile-field">
                        <label for="" class="col-sm-3 right-text">Image:</label>
                        <div class="col-sm-9">
                            <?php
                            echo $this->Form->input(
                                    'image', array(
                                'type' => 'file',
                                'label' => FALSE,
                                'required' => 'required'
                                    )
                            );
                            ?>
                        </div>
                    </div>


                    <div class="form-group profile-field">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-default">Add Course/Training</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function () {
        var dateFormat = "yy-mm-dd";
        from = $("#PostStartdate")
        .datepicker({
            minDate: 0,
            defaultDate: "+1w",
            changeMonth: true,
            dateFormat: dateFormat
        })
        .on("change", function () {
            to.datepicker("option", "minDate", getDate(this));
        }),
        to = $("#PostEnddate").datepicker({
            minDate: 0,
            defaultDate: "+1w",
            changeMonth: true,
            dateFormat: dateFormat
        })
        .on("change", function () {
            from.datepicker("option", "maxDate", getDate(this));
        });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }

        $( "#PostTypeOfCourse" ).change(function() {
          var value = $(this).val();
          
          if(value == 1)
          {
            $("#PostLocation").val('Online');
            $( "#PostLocation" ).prop( "disabled", true );
          }
          else
          {
            $("#PostLocation").val('');
            $( "#PostLocation" ).prop( "disabled", false );
          }
        });
    });
</script>