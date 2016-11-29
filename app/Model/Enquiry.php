<?php
App::uses('AppModel', 'Model');
/**
 * SiteSetting Model
 *
 * @property User $User
 */
class Enquiry extends AppModel {


        public $validate = array(

	);

		public $belongsTo = array(
			'Post' => array(
			   'className'  => 'Post',
			   'foreignKey' => 'post_id'
			)
		);
}
