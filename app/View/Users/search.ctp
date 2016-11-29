<!--<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>-->
<?php
//pr($courses);
?>

<section class="listing_result">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="left_filter">
                    <div class="left_filter-area">
                        <h4>Price Range</h4>
                        <div class="row text_box_filter">
                            <div class="col-md-12">
                                <p>
                                    <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                </p>
                                <div id="slider-range"></div>
                            </div>

                            <!--<div class="col-md-5">
                                <input type="text" />
                            </div>
                            <div class="col-md-2" style="padding-left:0;padding-right:0">
                                <p>to</p>
                            </div>
                            <div class="col-md-5">
                                <input type="text" />
                            </div>-->
                        </div>
                    </div>

                    <div class="left_filter-area">
                        <h4>Dates</h4>
                        <div class="row text_box_filter">
                            <div class="col-md-12">
                                <input type="text" id="startDate" class="form-control" placeholder="Start Date" />
                            </div>
                            <div class="col-md-12">
                                <p class="text-center">to</p>
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="endDate" class="form-control" placeholder="End Date" />
                            </div>
                            <div class="col-md-12">
                                <button type="button" id="dateSubmit" class="btn btn-default pull-left" style="margin-top: 10px;"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="left_filter-area">
                        <h4>Categories</h4>
                        <?php
                        foreach ($categories as $category) {
                            ?>
                            <div class="row text_box_filter">
                                <div class="col-md-2" style="padding:3% 6%;">
                                    <input type="radio" type="" name="cat" value="<?php echo $category['Category']['id']; ?>" <?php echo ($cat == $category['Category']['id']) ? 'checked' : ''; ?> />
                                </div>
                                <div class="col-md-10" style="padding-left:0;padding-right:0">
                                    <p><?php echo $category['Category']['category_name']; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- <div class="left_filter-area">
                        <h4>Skills</h4>
                        <?php
                        foreach ($skills as $skill) {
                            ?>
                            <div class="row text_box_filter">
                                <div class="col-md-2" style="padding:3% 6%;">
                                    <input type="checkbox" name="skills[]" value="<?php echo $skill['Skill']['id']; ?>" />
                                </div>
                                <div class="col-md-10" style="padding-left:0;padding-right:0">
                                    <p><?php echo $skill['Skill']['skill_name']; ?> (<?php echo count($skill['Post']); ?>)</p>
                                </div>					
                            </div>
                            <?php
                        }
                        ?>

                    </div> -->

                </div>
            </div>
            <div class="col-md-8">
                <div class="row seachfield-back-area">
                    <form>
                        <div class="form-group col-md-5">
                            <input type="text" placeholder="Search by keyword" id="keyword" name="keyword" class="form-control search-by-field" value="<?php echo $keyword; ?>" style="background-position: 3% 50%;" />
                        </div>
                        
                        <div class="form-group col-md-5">
                            <input type="text" placeholder="Location" id="location" name="location" class="form-control search-by-field" value="" style="background-position: 3% 50%;" />
                        </div>
                        
                        <div class="form-group col-md-1 col-md-offset-1">
                            <button class="btn btn-default search-by pull-right" type="button" id="keyword_btn">SEARCH</button>
                        </div>
                    </form>	
                </div>
                <div class="row serh_ruslt_box">
                    <?php
                    if (!empty($courses)) {
                        foreach ($courses as $course) {
                    ?>
                    <div class="media">
                        <?php
                        if ($course['Post']['featured'] == 1) {
                        ?>
                        <span class="boxRibbon">FEATURED</span>
                        <?php
                        }
                        
                        if ($course['User']['user_logo']!='') {
                            $img = $this->webroot .'user_logo/' . $course['User']['user_logo'];
                        } else {
                            $img = '';
                            $img = $this->webroot .'images/no_image.png';
                        }
                        
                        ?>
                        <div class="media-left media-middle">
                            <div class="img_hold">
                                <img class="media-object" src="<?php echo $img; ?>" alt="...">
                            </div>
                        </div>
                        <div class="media-body">
                            <b><?php echo $course['Post']['post_title']; ?></b>
                            <span>The Institute of Chartered Accountants in England and Wales</span>
                            <p><?php echo substr(strip_tags($course['Post']['post_description']), 0, 100); ?></p>
                            <ul>
                                <li><i class="fa fa-user"></i> <p> <?php $course['Post']['quantity']; ?> Course available</p></li>
                                <li>
                                    <p>Share:</p> <a href="" class="fa fa-linkedin"></a> <a href="" class="fa fa-facebook"></a> <a href="" class="fa fa-twitter"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="media-right media-middle">
                            <button class="normal"><i class="fa fa-graduation-cap"></i> Classroom</button>
                            <button class="more_info" onclick="location.href='<?php echo $this->webroot . 'users/coursedetail/'.$course['Post']['slug']; ?>'">More Info</button>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                    ?>
                    <div class="media">
                        <div class="media-body">
                            <b>Sorry, nothing matched your search criteria.</b>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    
                </div>
                <!-- <div class="listing-part" id="listing-part">
                <?php
                if (!empty($courses)) {
                    foreach ($courses as $course) {
                        ?>
                                             <div class="media listing-area">
                                                 <div class="media-left">
                                                     <img src="<?php echo $this->webroot . 'img/post_img/' . $course['PostImage'][0]['originalpath']; ?>" width="80" height="80"  alt=""/>
                                                 </div>
                                                 <div class="media-body listing-mid-area">
                                                     <h4 class="media-heading"><?php echo $course['Post']['post_title']; ?></h4>
                                                     <p><?php echo substr(strip_tags($course['Post']['post_description']), 0, 100); ?></p>
                                                     <div class="star">
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                         <i class="fa fa-star" aria-hidden="true"></i>
                                                     </div>
                        <?php
                        echo $this->Html->link(
                                'View Details', array(
                            'controller' => 'users',
                            'action' => 'coursedetail',
                            base64_encode($course['Post']['id'])
                                ), array('class' => 'btn btn-default pull-left')
                        );
                        ?>
                                                 </div>
                                                 <div class="media-right">
                                                     <div class="listing-rt-area">
                                                         <img src="<?php echo $this->webroot; ?>images/skin-health.jpg" width="60" height="60"  alt=""/> 
                                                         <p>$<?php echo $course['Post']['price']; ?></p>
                                                     </div>
                                                 </div>
                                             </div>
                        <?php
                    }
                } else {
                    ?>
                                 <div class="media listing-area">
                                     <h3>Not found</h3>
                                 </div>
                    <?php
                }
                ?>
 
                 </div>
                -->

            </div>
        </div>
    </div>
</section>

<script>
    (function ($) {
        var cat = '';
        var keyword = '';
        var stPrice = '';
        var enPrice = '';
        var startDate = '';
        var endDate = '';
        var location = '';
        var skills = [];

        $('input[name="cat"], input[name="skills[]"]').change(function () {
            get_value();
        });

        $('#keyword_btn').click(function () {
            get_value();

        });

        $("#slider-range").slider({
            range: true,
            min: <?php echo ceil($maxMin[0]['min']); ?>,
            max: <?php echo ceil($maxMin[0]['max']); ?>,
            values: [<?php echo ceil($maxMin[0]['min']); ?>, <?php echo ceil($maxMin[0]['max']); ?>],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
            },
            change: function (event, ui) {
                stPrice = ui.values[0];
                enPrice = ui.values[1];
                get_value();
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

        var dateFormat = "yy-mm-dd",
                from = $("#startDate")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    dateFormat: dateFormat
                })
                .on("change", function () {
                    to.datepicker("option", "minDate", getDate(this));
                }),
                to = $("#endDate").datepicker({
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

        $('#dateSubmit').click(function () {
            if ($('#startDate').val() == '') {
                $('#startDate').trigger('focus');
            } else if ($('#endDate').val() == '') {
                $('#endDate').trigger('focus');
            } else {
                startDate = $('#startDate').val();
                endDate = $('#endDate').val();
                get_value();
            }
        });

        function get_value() {
            cat = $('input[name="cat"]:checked').val();
            keyword = $('#keyword').val();
            startPrice = stPrice;
            endPrice = enPrice;
            startDate = $('#startDate').val();
            endDate = $('#endDate').val();
            location = $('#location').val();
            skills = [];

            $('input[name="skills[]"').each(function () {
                if ($(this).is(':checked')) {
                    skills.push($(this).val());
                }
            });

            ajaxSearch(cat, keyword, startPrice, endPrice, startDate, endDate, skills);
        }

        function ajaxSearch(cat, keyword, startPrice, endPrice, startDate, endDate, skills) {

            $.ajax({
                url: '<?php echo $this->webroot . 'users/ajaxsearch' ?>',
                type: 'post',
                dataType: 'json',
                data: {
                    cat: cat,
                    keyword: keyword,
                    startPrice: startPrice,
                    endPrice: endPrice,
                    startDate: startDate,
                    endDate: endDate,
                    location: location,
                    skills: skills
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#loading').hide();
                    if (data.ack == '1') {
                        $('.serh_ruslt_box').html(data.html);
                    } else {
                        $('.serh_ruslt_box').html(data.html);
                    }
                }
            });
        }


    })(jQuery);
</script>