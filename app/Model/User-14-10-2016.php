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

class User extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'first_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'user_pass' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'on' => 'create',
                'message' => 'A password is required'
            )
        ),
        'last_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A firstname is required'
            )
        ),
        'email_address' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'An email is required'
            )
        ),
    );

    /* public function beforeSave($options = array()) {
      if (isset($this->data[$this->alias]['password'])) {
      $this->data[$this->alias]['password'] = md5(
      $this->data[$this->alias]['password']
      );
      }
      return true;
      } */

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    //public $hasOne = 'UserImage';
    public $hasMany = array(
        'Marketplace' => array(
            'className' => 'Marketplace',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'MarketplaceRating' => array(
            'className' => 'MarketplaceRating',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'UserImage' => array(
            'className' => 'UserImage',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    /* public $hasMany = array(
      'Task' => array(
      'className' => 'Task',
      'foreignKey' => 'user_id',
      'dependent' => false,
      'conditions' => '',
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'exclusive' => '',
      'finderQuery' => '',
      'counterQuery' => ''
      ),
      'Comment' => array(
      'className' => 'Comment',
      'foreignKey' => 'user_id',
      'dependent' => false,
      'conditions' => '',
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'exclusive' => '',
      'finderQuery' => '',
      'counterQuery' => ''
      ),
      'Skill' => array(
      'className' => 'Skill',
      'foreignKey' => 'user_id',
      'dependent' => false,
      'conditions' => '',
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'exclusive' => '',
      'finderQuery' => '',
      'counterQuery' => ''
      ),
      'Activity' => array(
      'className' => 'Activity',
      'foreignKey' => 'user_id',
      'dependent' => false,
      'conditions' => '',
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'exclusive' => '',
      'finderQuery' => '',
      'counterQuery' => ''
      ),

      ); */
    public $belongsTo = array(
        'Role' => array(
            'className' => 'Adminrole',
            'foreignKey' => 'admin_type'
        ),
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country'
        ),
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state'
        ),
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city'
        ),
        'Lga' => array(
            'className' => 'Lga',
            'foreignKey' => 'lga'
        ),
        'MembershipPlan' => array(
           'className'  => 'MembershipPlan',
           'foreignKey' => 'membership_plan_id'
        )
    );

     public $hasOne = array(
        'Company' => array(
            'className' => 'CompanyDetail'
        )
    );

}
