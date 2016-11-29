<div class="shippingAddresses view">
<h2><?php echo __('Order'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($RequestQuote['RequestQuote']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($RequestQuote['User']['id'], array('controller' => 'users', 'action' => 'view', $RequestQuote['User']['id'])); ?>
			&nbsp;
		</dd>
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
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Shipping Address'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Shipping Address'), array('action' => 'delete', $order['Order']['id']), null, __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Shipping Addresses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shipping Address'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div> -->
