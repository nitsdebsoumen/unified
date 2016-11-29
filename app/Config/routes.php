<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'users', 'action' => 'home'));
        Router::connect('/landing', array('controller' => 'users', 'action' => 'landing'));
        Router::connect('/contact_us', array('controller' => 'users', 'action' => 'contact_us'));
	Router::connect('/admin', array('controller' => 'users', 'action' => 'index', 'admin' => true, 'prefix' => 'admin'));
        
        
        
        //Router::connect('/', array('controller' => 'users', 'action' => 'index', 'admin' => true));
        //Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/sent-messages/contact/*', array('controller' => 'sent_messages', 'action' => 'contact'));
	
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/errands', array('controller' => 'tasks', 'action' => 'index'));
	Router::connect('/errands/index/*', array('controller' => 'tasks', 'action' => 'index'));
        Router::connect('/errands/detail/*', array('controller' => 'tasks', 'action' => 'detail'));
        Router::connect('/errands/offer/*', array('controller' => 'tasks', 'action' => 'offer'));
        Router::connect('/errands/report_errand/*', array('controller' => 'tasks', 'action' => 'report_task'));
        Router::connect('/errands/request_payment/*', array('controller' => 'tasks', 'action' => 'request_payment'));
        Router::connect('/errands/release_fund/*', array('controller' => 'tasks', 'action' => 'release_fund'));
        Router::connect('/errands/invite', array('controller' => 'tasks', 'action' => 'invite'));
        Router::connect('/errands/pay_success/*', array('controller' => 'tasks', 'action' => 'pay_success'));
        Router::connect('/users/my_errand/*', array('controller' => 'users', 'action' => 'my_task'));
        Router::connect('/users/my_assign_errand/*', array('controller' => 'users', 'action' => 'my_assign_task'));
        Router::connect('/user/profile/*', array('controller' => 'users', 'action' => 'dashboard'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
