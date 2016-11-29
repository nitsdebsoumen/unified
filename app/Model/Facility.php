<?php
App::uses('AppModel', 'Model');
/**
 * Seo Model
 *
 */
class Facility extends AppModel 
{

/**
 * Display field
 *
 * @var array
 */

	public $validate = array();

	var $name = 'Facility';
    var $hasAndBelongsToMany = array(
        'Venue' => array(
            'className' => 'Venue',
            'joinTable' => 'venue_facilities',
            'foreignKey' => 'facility_id',
            'associationForeignKey' => 'venue_id'
        ),
    );

}
