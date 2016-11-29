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
                    if (!empty($allstudents)) {
                        foreach ($allstudents as $allstudent) {
                    ?>
                    <div class="media">
                        <?php
                        /*if ($course['Post']['featured'] == 1) {
                        ?>
                        <span class="boxRibbon">FEATURED</span>
                        <?php
                        }*/
                        
                        if (isset($allstudent['User']['user_image']) && $allstudent['User']['user_image'] != '') {
                            $img = $this->webroot . 'user_images/' . $allstudent['User']['user_image'];
                        } else {
                            $img = $this->webroot . 'user_images/default.png';
                        }
                        
                        ?>
                        <div class="media-left media-middle">
                            <div class="img_hold">
                                <img class="media-object" src="<?php echo $img; ?>" alt="..." />
                            </div>
                        </div>
                        <div class="media-body">
                            <b><?php echo $allstudent['User']['first_name'] . ' ' . $allstudent['User']['first_name']; ?></b>
                            <span>The Institute of Chartered Accountants in England and Wales</span>
                            <p>Email: <?php echo $allstudent['User']['email_address']; ?></p>
                            <p>Address: <?php echo $allstudent['User']['address']; ?></p>
                            
                        </div>
                        <div class="media-right media-middle">
                            <button class="more_info" onclick="location.href='<?php echo $this->webroot . 'users/profile/'.base64_encode($allstudent['User']['id']); ?>'">More Info</button>
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