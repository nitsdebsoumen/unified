<?php
App::uses('AppModel', 'Model');
/**
 * SiteSetting Model
 *
 * @property User $User
 */
class Accreditation extends AppModel {


        public $validate = array(

	);

      public $belongsTo = array(
        'AccreditationList' => array(
            'className' => 'AccreditationList',
            'foreignKey' => 'accreditation_id'
        )
      );



}
