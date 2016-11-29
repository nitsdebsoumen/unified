<?php
App::uses('AppModel', 'Model');
/**
 * SiteSetting Model
 *
 * @property User $User
 */
class CourseLocation extends AppModel {

// public $validate = array(
// 		'category_name' => array(
//                 'required' => array(
//                 'rule' => array('notEmpty'),
//                 'message' => 'A name is required'
//               )
//            )
// 	);

public $belongsTo = array(
        // 'Role' => array(
        //     'className' => 'Adminrole',
        //     'foreignKey' => 'admin_type'
        // ),
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country'
        ),
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state'
        ),
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city'
        ),
        'MembershipPlan' => array(
           'className'  => 'MembershipPlan',
           'foreignKey' => 'membership_plan_id'
        ),
        'Lga' => array(
           'className'  => 'Lga',
           'foreignKey' => 'lga_id'
        )
    );



}
