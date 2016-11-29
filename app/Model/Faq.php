<?php

App::uses('AppModel', 'Model');

/**
 * Faq Model
 *
 * @property User $User
 * @property BlogComment $BlogComment
 */
class Faq extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array();
    public $belongsTo = array(
        'Faqcategory' => array(
            'className' => 'Faqcategory',
            'foreignKey' => 'faqcategory_id'
        )
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed
}
