<?php
App::uses('AppModel', 'Model');
#App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * @property EmailNotification $EmailNotification
 * @property FavoriteList $FavoriteList
 * @property FavoriteShop $FavoriteShop
 * @property FavoriteTreasury $FavoriteTreasury
 * @property InboxMessage $InboxMessage
 * @property Preference $Preference
 * @property Privacy $Privacy
 * @property Security $Security
 * @property SentMessage $SentMessage
 * @property ShippingAddress $ShippingAddress
 * @property Shop $Shop
 */
class Activity extends AppModel {



/**
 * Validation rules
 *
 * @var array
 */
	/*public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = md5(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	
        public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
