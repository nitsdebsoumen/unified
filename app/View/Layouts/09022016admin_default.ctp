<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Marketplace Admin Panel');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>
        $(document).ready(function(){ 
		setTimeout(function() {
			$('.message').fadeOut('slow');
		}, 2000);
		setTimeout(function() {
			$('.success').fadeOut('slow');
		}, 2000);
	});
        </script>
	<?php
		echo $this->Html->meta('icon');		
		if($this->params['controller']=='users' && ($this->params['action']=='admin_index' || $this->params['action']=='admin_fotgot_password'))
		{
			echo $this->Html->css('adminstyle');
		}else{
			echo $this->Html->css('cake.generic');
		}

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<?php
		if($this->params['controller']=='users' && ($this->params['action']=='admin_index' || $this->params['action']=='admin_fotgot_password'))
		{
		?>
		<?php
		}
		else
		{
		?>		
		<div id="header">
			<h1>Marketplace Admin Panel<?php //echo ($cakeDescription); ?></h1>
		</div>
		<?php
		}
		?>
		<div id="content">
			<div style="text-align:center;">
			<?php echo $this->Session->flash(); ?>
			</div>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php #echo $this->Html->link($this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')), 'http://www.cakephp.org/',array('target' => '_blank', 'escape' => false));?>
		</div>
	</div>  	
	
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
