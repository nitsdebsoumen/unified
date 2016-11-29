<section class="listing_result">
  <div class="container">
    <div class="row">
        <?php echo($this->element('leftpanel'))?>
        <div class="col-md-8">
            <div class="right_bar">

<div class="shippingAddresses view">
<h2><?php echo __('Order'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($RequestQuote['RequestQuote']['id']); ?>
			&nbsp;
		</dd>
		<!-- <dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($RequestQuote['User']['id'], array('controller' => 'users', 'action' => 'view', $RequestQuote['User']['id'])); ?>
			&nbsp;
		</dd> -->
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($RequestQuote['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($RequestQuote['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course Title'); ?></dt>
		<dd>
			<?php echo h($RequestQuote['Post']['post_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quote '); ?></dt>
		<dd>
			<?php echo h($RequestQuote['RequestQuote']['quotes']); ?>
			 <?php 
              $arr=explode('.',$RequestQuote['RequestQuote']['quotes']);
              $extention = end($arr);
              if ($extention=='jpeg' || $extention=='jpg' || $extention=='png' ) { ?>
                  <img src="<?php echo $this->webroot.'quote/'.$RequestQuote['RequestQuote']['quotes'] ?>" style="width: 30%;" />
             <?php }

             elseif($extention=='pdf' || $extention=='doc' || $extention== 'docx') { ?>
              <a href='<?php echo $this->webroot.'quote/'.$RequestQuote['RequestQuote']['quotes'] ?>' download="" class="btn btn-primary">
                Download
              </a>                
            <?php  }
            ?>
			&nbsp;
		</dd>
		
	
	</dl>
</div>
</div>
</div>
</div>
</div>