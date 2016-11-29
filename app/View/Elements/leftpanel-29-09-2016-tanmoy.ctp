<div class="col-md-3">
    <div class="update-profile-pic" style="cursor:pointer;">
        <span id="replaceimage"><img src="<?php if (isset($userdetails['User']['user_image']) && $userdetails['User']['user_image'] != '') { ?><?php echo $this->webroot; ?>user_images/<?php
                echo $userdetails['User']['user_image'];
            } else {
                echo $this->webroot;
                ?>user_images/update-profile-pic.jpg<?php } ?> " width="190" height="190" alt=""/></span>
        <div class="update-pic-icon" >
            <div class="update-pic-img" ><i style="cursor:pointer;"  class="fa fa-pencil-square-o" aria-hidden="true" id="uploadbox">
                </i><input type="file" name="uploadbox" class="uploadbox" id="form" style="display:none">
            </div>
        </div>
    </div>
    <div class="left_bar">
        <?php
        //pr($userimage);
        ?>
        <ul>
             <?php
            if ( $userdetails['User']['admin_type']==1 || $userdetails['User']['admin_type']==2  )
            { ?>
             <li>
                <a href="<?php echo $this->webroot .'users/provider_dashboard/'.base64_encode($userdetails['User']['id']); ?>"><i class="fa fa-user icon" aria-hidden="true"></i><?php echo "Dashboard"; ?></a>
            </li>
            <?php } ?>


            <li>
                <a href="<?php echo $this->webroot .'users/profile/'.base64_encode($userdetails['User']['id']); ?>"><i class="fa fa-user icon" aria-hidden="true"></i><?php echo PROFILE_DETAILS; ?></a>
            </li>
            <li>
                <a href="<?php echo $this->webroot . 'users/change_password'; ?>"><i class="fa fa-user icon" aria-hidden="true"></i><?php echo CHANGE_PASSWORD; ?></a>
            </li>


             <?php
            if ( $userdetails['User']['admin_type']== 3 || $userdetails['User']['admin_type']== 4 )
            { ?>
            <li>
                <a href="<?php echo $this->webroot; ?>wishlists/index"><i class="fa fa-heart icon" aria-hidden="true"></i> <?php echo WISHLIST; ?></a>
            </li>
            <?php } ?>


            <li>
                <a href="<?php echo $this->webroot; ?>bookings/index"><i class="fa fa-calendar icon" aria-hidden="true"></i> <?php echo BOOKINGS; ?></a>
            </li>

            <?php
            if ( $userdetails['User']['admin_type']==1 || $userdetails['User']['admin_type']==2 )
            { ?>

             <li>
                <a href="<?php echo $this->webroot; ?>users/company_details"><i class="fa fa-tag icon" aria-hidden="true"></i> <?php echo "Company Detail"; ?></a>
            </li>

            <li> <a href="<?php echo $this->webroot; ?>kycdocs/addkyc"><i class="fa fa-bars" aria-hidden="true"></i><?php echo ' '.KYC_VERIFICATION; ?></a>
               <!--  <ul>
                    <li>
                <a href="<?php echo $this->webroot; ?>kycdocs/kyclisting"><i class="fa fa-plus icon" aria-hidden="true"></i><?php echo KYC_LISTING; ?></a>
                    </li>
                    <li>
                <a href="<?php echo $this->webroot; ?>kycdocs/addkyc"><i class="fa fa-plus icon" aria-hidden="true"></i><?php echo ADD_KYC; ?></a>
                    </li>
                </ul> -->
            </li>


            <li>
                <a href="#"><i class="fa fa-star icon" aria-hidden="true"></i> <?php echo REVIEWS; ?></a>
            </li>


            <li>
                <a href="<?php echo $this->webroot; ?>posts/add_course"><i class="fa fa-plus icon" aria-hidden="true"></i><?php echo ADD_COURSE.'/'.TRAINING; ?></a>
            </li>
            <li>
                <a href="<?php echo $this->webroot; ?>posts/list_course"><i class="fa fa-list-alt icon" aria-hidden="true"></i> <?php echo LIST_COURSE.'/'.TRAINING; ?></a>
            </li>
                <li>
                <a href="<?php echo $this->webroot; ?>posts/csv_upload"><i class="fa fa-list-alt icon" aria-hidden="true"></i> <?php echo 'Course CSV Upload'; ?></a>
            </li>

              <?php
             }
            ?>

               <?php
            if ( $userdetails['User']['admin_type']==1 || $userdetails['User']['admin_type']==2 && $userdetails['User']['admin_type']==1)
            { ?>

            <li> <i class="fa fa-bars" aria-hidden="true"></i><?php echo ' '.VENUE_MANAGEMENT; ?>
                <ul>
                    <li>
                    <a href="<?php echo $this->webroot; ?>venues/index"><i class="fa fa-plus icon" aria-hidden="true"></i><?php echo VENUE_LISTING; ?></a>
                    </li>
                    <li>
                    <a href="<?php echo $this->webroot; ?>venues/venue_add"><i class="fa fa-plus icon" aria-hidden="true"></i><?php echo ADD_VENUES; ?></a>
                    </li>
                     <li>
                    <a href="<?php echo $this->webroot; ?>venues/venue_csv_upload"><i class="fa fa-plus icon" aria-hidden="true"></i><?php echo "Venue CSV Upload"; ?></a>
                    </li>
                </ul>
            </li>




     <!--        <li> <a href="<?php echo $this->webroot; ?>students"><i class="fa fa-bars" aria-hidden="true"></i><?php echo STUDENT_MANAGEMENT; ?></a>

            </li> -->
           <!--
            <li>
                <a href="<?php echo $this->webroot; ?>posts/import_csv"><i class="fa fa-list-alt icon" aria-hidden="true"></i><?php echo ADD_CSV; ?></a>
            </li> -->
            <?php
             }
            ?>


        <!--     <li>
                <a href="<?php echo $this->webroot; ?>posts/course_schedule"><i class="fa fa-tag icon" aria-hidden="true"></i> <?php echo COURSE_SCHEDULE; ?></a>
            </li> -->

            <?php if ( $userdetails['User']['admin_type']== 1 || $userdetails['User']['admin_type']== 2 || $userdetails['User']['admin_type']== 3 )
            { ?>

            <?php } ?>
           <!--  <li>
                <a href="<?php echo $this->webroot; ?>wishlists/index"><i class="fa fa-plus icon" aria-hidden="true"></i><?php echo MY_WISHLISTS; ?></a>
            </li> -->
        <!--     <li>
                <a href="<?php echo $this->webroot; ?>bookings/index"><i class="fa fa-list-ul" aria-hidden="true"></i><?php echo ' Booking History'; ?></a>
            </li> -->
            <?php
            if ( $userdetails['User']['admin_type']== 1 || $userdetails['User']['admin_type']== 2 )
            { ?>
            <li>
                <a href="<?php echo $this->webroot; ?>request_quotes/add"><i class="fa fa-plus icon" aria-hidden="true"></i><?php echo ' Add Quotes'; ?></a>
            </li>

            <li>
               <a href="<?php echo $this->webroot; ?>request_quotes/index"><i class="fa fa-list-ul" aria-hidden="true"></i><?php echo ' List Quotes'; ?></a>
            </li>
            <?php } ?>


            <?php
            if ( $userdetails['User']['admin_type']== 1 || $userdetails['User']['admin_type']== 2 )
            { ?>
            <li>
                <a href="<?php echo $this->webroot; ?>categories/add"><i class="fa fa-plus icon" aria-hidden="true"></i><?php echo ' Categories'; ?></a>
            </li>
            <?php } ?>


        </ul>
    </div>
</div>


<script>


    $(document).on("change", "#form", function () {

        var file_data = $("#form").prop("files")[0];   // Getting the properties of file from file field
        var form_data = new FormData();                  // Creating object of FormData class
        form_data.append("file", file_data)              // Appending parameter named file with properties of file_field to form_data
        //form_data.append("user_id", 123)                 // Adding extra parameters to form_data
        $.ajax({
            url: "<?php echo $this->webroot . 'users/upload_image'; ?>",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data, // Setting the data attribute of ajax with file_data
            type: 'post', success: function (result) {
                $("#replaceimage").html('');
                $("#replaceimage").html('<img src="<?php echo $this->webroot; ?>user_images/' + result + '" />');
            }
        });
    })
    $(document).on("click", "#uploadbox", function () {
        $("#form").trigger("click");
    });


</script>