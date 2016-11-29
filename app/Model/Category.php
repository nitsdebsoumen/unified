<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property User $User
 */
class Category extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'category_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required'
            )
        )
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
        public $hasMany = array(
		'CategoryImage' => array(
			'className' => 'CategoryImage',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	    	'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
                'Children'=>array(
               'className'=>'Category',
               'foreignKey'=>'parent_id'
            )
                
		
	);
       
public $belongsTo = array(
    'Country'=>array(
       'className'=>'Country',
       'foreignKey'=>'country_id'
    )
  );

public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['category_name'])) 
    {
        $this->data[$this->alias]['slug'] = $this->createSlug($this->data[$this->alias]['category_name']);
    }
    return true;
}

}
