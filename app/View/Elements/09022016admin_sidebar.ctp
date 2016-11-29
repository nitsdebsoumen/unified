<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
                <li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard')); ?></li>
                <li><?php echo $this->Html->link(__('Manage Logo'), array('controller' => 'site_settings', 'action' => 'sitelogo', 1)); ?></li>
		<li><?php echo $this->Html->link(__('Site Settings'), array('controller' => 'site_settings', 'action' => 'edit', 1)); ?></li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'list')); ?></li>
		<!--<li><?php echo $this->Html->link(__('List Partners'), array('controller' => 'users', 'action' => 'partners')); ?></li>-->
		<!--<li><?php echo $this->Html->link(__('List Shops'), array('controller' => 'shops', 'action' => 'index')); ?></li>-->
		<!--<li><?php echo $this->Html->link(__('Featured Shops'), array('controller' => 'shops', 'action' => 'featured')); ?></li>-->
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('Add Tasks'), array('controller' => 'tasks', 'action' => 'add')); ?></li>
                <li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'list')); ?></li>
                <li><?php echo $this->Html->link(__('Contents'), array('controller' => 'contents', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Email Template'), array('controller' => 'email_templates', 'action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('Newsletter Subscribers'), array('controller' => 'newsletters', 'action' => 'index')); ?></li>
		<!--<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'listings', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Product'), array('controller' => 'listings', 'action' => 'index')); ?></li>
                

		<li><?php echo $this->Html->link(__('New Attribute'), array('controller' => 'attributes', 'action' => 'add')); ?></li>-->
		<!--<li><?php echo $this->Html->link(__('List Attributes'), array('controller' => 'attributes', 'action' => 'index')); ?></li>-->
		<!--<li><?php echo $this->Html->link(__('Orders'), array('controller' => 'orders', 'action' => 'index')); ?></li>-->
		<!--<li><?php echo $this->Html->link(__('Newsletter Subscribers'), array('controller' => 'newsletters', 'action' => 'index')); ?></li>-->
		<!--<li><?php echo $this->Html->link(__('New Partnership Request'), array('controller' => 'partners', 'action' => 'add')); ?></li>-->
		<!--<li><?php echo $this->Html->link(__('List Partnership Requests'), array('controller' => 'partners', 'action' => 'index')); ?></li>-->
		<!--<li><?php echo $this->Html->link(__('List Testimonial'), array('controller' => 'testimonials', 'action' => 'index')); ?></li>-->
        <!--<li><?php echo $this->Html->link(__('New Testimonial'), array('controller' => 'testimonials', 'action' => 'add')); ?></li>-->
                <li><?php echo $this->Html->link(__('Edit Profile'), array('controller' => 'users', 'action' => 'admin_edit', 2)); ?> </li>	
                <li><?php echo $this->Html->link(__('Change Password'), array('controller' => 'users', 'action' => 'admin_changepwd')); ?> </li>	
                <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'admin_logout')); ?> </li>		
	</ul>
</div>