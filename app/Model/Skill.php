<?php
App::uses('AppModel', 'Model');

class Skill extends AppModel {
    var $name = 'Skill';
    var $hasAndBelongsToMany = array(
        'Post' => array(
            'className' => 'Post',
            'joinTable' => 'post_skills',
            'foreignKey' => 'skill_id',
            'associationForeignKey' => 'post_id'
        ),
    );
}