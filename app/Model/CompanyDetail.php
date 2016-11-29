<?php

App::uses('AppModel', 'Model');

/**
 * Faq Model
 *
 * @property User $User
 * @property BlogComment $BlogComment
 */
class CompanyDetail extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array();

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country'
        ),
        'Bank' => array(
            'className' => 'Bank',
            'foreignKey' => 'bank_id'
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
        )
   	);

}