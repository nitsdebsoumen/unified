<?php

App::uses('AppModel', 'Model');

class CourseRequest extends AppModel {
    public $validate = array();
    
    public $belongsTo = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'post_id'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
}