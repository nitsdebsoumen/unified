<?php
App::uses('AppModel', 'Model');

class VenueImage extends AppModel {

	public $belongsTo = array(
    'Venue'=>array(
       'className'=>'Venue',
       'foreignKey'=>'venue_id'
    )
  );

}