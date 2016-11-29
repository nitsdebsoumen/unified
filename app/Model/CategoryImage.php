<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property User $User
 */
class CategoryImage extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
 public $belongsTo = array(
    'Category'=>array(
       'className'=>'Category',
       'foreignKey'=>'category_id'
    )
  );

}
