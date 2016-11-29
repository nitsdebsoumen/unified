<?php
App::uses('AppModel', 'Model');
/**
 * Seo Model
 *
 */
class Event extends AppModel 
{

/**
 * Display field
 *
 * @var array
 */

	public $validate = array();

	var $name = 'Event';
    var $hasAndBelongsToMany = array(
        'Venue' => array(
            'className' => 'Venue',
            'joinTable' => 'venue_events',
            'foreignKey' => 'event_id',
            'associationForeignKey' => 'venue_id'
        ),
    );

}
