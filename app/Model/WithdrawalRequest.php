<?php
App::uses('AppModel', 'Model');
/**
 * State Model
 *
 * @property Preference $Preference
 */
class WithdrawalRequest extends AppModel {

    public $belongsTo = array(
        'User' => array(
           'className'  => 'User',
           'foreignKey' => 'user_id'
        )
     );

}
