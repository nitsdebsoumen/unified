<?php
App::uses('AppModel', 'Model');
/**
 * State Model
 *
 * @property Preference $Preference
 */
class Wishlist extends AppModel {
    public $validate = array();

     public $belongsTo = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'post_id'
        )
    );

}
