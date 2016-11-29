<?php
//pr($settings);
//echo $cookieHelper->read('landing');
//echo $cookieHelper->write('landing', '2', $encrypt = false, $expires = null);
//echo $cookieHelper->read('landing');
?>
<section class="inner_banners">
    <img src="<?php echo $this->webroot; ?>images/contact.jpg" alt="" /> 
    <aside>
        <b>CONTACT US</b>
        <p>We’d love to hear from you</p>
    </aside>
</section>
<section class="contact_holder">
    <div class="container">
        <div class="row">
            <div class="col-md-6 left_contact">
                <i>Please fill the form & send it to us.</i>
                <?php
                if($this->Session->read('Contact.ack') == '1') {
                    echo '<p class="text-success">'.$this->Session->read('Contact.msg').'</p>';
                    if($this->Session->read('Contact.msg')) {
                        unset($_SESSION['Contact']);
                    }
                } else {
                    echo '<p class="text-danger">'.$this->Session->read('Contact.msg').'</p>';
                    if($this->Session->read('Contact.msg')) {
                        unset($_SESSION['Contact']);
                    }
                }
                ?>
                <form action="<?php echo $this->webroot . 'contact_us'; ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Your Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="data[Contact][name]" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Your Email</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="data[Contact][email_address]" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Subject</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="data[Contact][subject]" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Your Message</label>
                        <textarea class="form-control" id="exampleInputPassword1" name="data[Contact][message]" placeholder=""></textarea>
                    </div>
                    <button type="submit" class="btn btn-default pull-right">SEND</button>
                </form>
            </div>
            <div class="col-md-6 contact_info">
                <h3>Contact Information:</h3>
                <ul>
                    <li><i class="fa fa-map-marker"></i><span><?php echo $settings['Setting']['address']; ?></span></li>
                    <li><i class="fa fa-phone"></i><span><?php echo $settings['Setting']['phone']; ?></span></li>
                    <li><i class="fa fa-envelope"></i><span>service@ladderng.com<?php //echo $settings['Setting']['site_email']; ?></span></li>
                    <li><i class="fa fa-skype"></i><span><?php echo $settings['Setting']['skype']; ?></span></li>
                </ul>
                <h3>Map Location:</h3>
                    <!--<img src="<?php echo $this->webroot; ?>images/map_section.jpg" alt="" class="img-responsive"/>-->
                    <iframe width="100%" height="230" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $settings['Setting']['address']; ?>&output=embed"></iframe>
            </div>
        </div>
    </div>
</section>
