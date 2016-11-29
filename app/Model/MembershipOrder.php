<?php
App::uses('AppModel', 'Model');
/**
 * State Model
 *
 * @property Preference $Preference
 */
class MembershipOrder extends AppModel {

    public $belongsTo = array(
        'MembershipPlan' => array(
           'className'  => 'MembershipPlan',
           'foreignKey' => 'membership_plan_id'
        ),
         'User' => array(
           'className'  => 'User',
           'foreignKey' => 'user_id'
        )
    );

}
