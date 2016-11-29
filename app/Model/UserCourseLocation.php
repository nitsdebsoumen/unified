<?php
App::uses('AppModel', 'Model');
/**
 * SiteSetting Model
 *
 * @property User $User
 */
class UserCourseLocation extends AppModel {

public $validate = array();

public $belongsTo = array(
    'Location'=>array(
       'className'=>'CourseLocation',
       'foreignKey'=>'course_locations_id'
    )
  );


}
