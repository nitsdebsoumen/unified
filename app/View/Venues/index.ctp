
<script>
    $('nav.navbar').removeClass('navbar-fixed-top').addClass('navbar-inner');
</script>
<section class="listing_result">
    <div class="container">
        <div class="row">
            
            <?php echo($this->element('leftpanel'))?>
            
            <div class="col-md-9">
                <div class="row serh_ruslt_box">
                    <?php

                    if (!empty($all_venue)) {
                        foreach ($all_venue as $all_venue) {
                    ?>
                    <div class="media">
                        
                        <div class="media-left media-middle">
                            <div class="img_hold">
                                
                            </div>
                        </div>
                        <div class="media-body">
                            <b><?php echo $all_venue['Venue']['venue_name']; ?></b>
                            <!--<span>The Institute of Chartered Accountants in England and Wales</span>-->
                            <p>Description: <?php echo $all_venue['Venue']['description']; ?></p>
                            <p>Size: <?php echo $all_venue['Venue']['size']; ?></p>
                            <p>Price: <?php echo '$'. $all_venue['Venue']['price']; ?></p>
                        </div>
                        <div class="media-right media-middle">
                            <button class="more_info"  onclick="location.href='<?php echo $this->webroot . 'users/venue_page/'.$all_venue['Venue']['slug']; ?>'">More Info</button>
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

            </div>
        </div>
    </div>
</section>