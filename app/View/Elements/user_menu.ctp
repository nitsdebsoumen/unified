<section class="new_menu" style="width: 100%;height: auto;background: #F8F8F8;">



 
    <nav class="navbar navbar-default" style="padding: 10px 0;">
  <div class="container">
    <div class="row new_menu">
      
      <div class="col-md-12">
   
    <ul class="nav navbar-nav second">
      <li class=""><a href="<?php echo $this->webroot; ?>users/dashboard">Dashboard</a></li>

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Errand Summary<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo $this->webroot; ?>users/my_errand">Errands Posted</a></li>
          <li><a href="<?php echo $this->webroot; ?>users/my_assign_errand">Errands Running </a></li>
          <li><a href="<?php echo $this->webroot; ?>users/review">Reviews</a></li>
        </ul>
      </li>

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Payments <?php echo((isset($PaymentNot) && $PaymentNot!=0)?'<span class="notify">'.$PaymentNot.'</span>':'');?><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo $this->webroot.'users/payment_history';; ?>">Payment History</a></li>
          <li><a href="<?php echo $this->webroot; ?>users/billing">Update Billing</a></li>
        </ul>
      </li>

      <li><a href="<?php echo $this->webroot; ?>notifications/">Alerts <?php echo((isset($notiCnt) && $notiCnt!=0)?'<span class="notify">'.$notiCnt.'</span>':'');?></a></li>

      <li><a href="<?php echo $this->webroot; ?>inbox_messages">Messages <?php echo((isset($inbxMsgCnt) && $inbxMsgCnt!=0)?'<span class="notify">'.$inbxMsgCnt.'</span>':'');?></a></li>

       <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo $this->webroot;?>users/editprofile">Edit My Profile</a></li>
          <li><a href="<?php echo $this->webroot;?>users/skill">Skillset & Experience</a></li>
          <li><a href="<?php echo $this->webroot;?>users/verification">Verifications</a></li>
          <li><a href="<?php echo $this->webroot;?>users/change_password">Security Setting </a></li>
          </ul>
      </li>

    </ul>

</div>

    </div>
  </div>
</nav>


</section>




<style type="text/css">
  .navbar-default ul.navbar-nav.second > li > a {color: #000!important;}
   .navbar-default ul.navbar-nav.second > li > a.active {color: #000!important;}
    .navbar-default ul.navbar-nav.second > li {padding: 5px 10px;}
    .navbar-default ul.navbar-nav.second > li:last-child{border-right: none;}
    .navbar-default ul.navbar-nav.second > li{border-right: 1px solid #ccc;}

    .dropdown-menu {z-index: 99999999;}
    /*.new_menu{width:85%; margin:0 auto;}
    @media screen and (max-width:900px) {
      .new_menu{width:100%;}
    }*/

  </style>