<?php
App::uses('AppModel', 'Model');
/**
 * State Model
 *
 * @property Preference $Preference
 */
class RequestQuote extends AppModel {

    public $belongsTo = array(
        'Post' => array(
           'className'  => 'Post',
           'foreignKey' => 'post_id'
        ),
         'User' => array(
           'className'  => 'User',
           'foreignKey' => 'user_id'
        )
    );

}
