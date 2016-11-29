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
class PortfolioImage extends AppModel {



/**
 * Validation rules
 *
 * @var array
 */
	


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
