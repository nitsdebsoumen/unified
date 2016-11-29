<?php
App::uses('AppModel', 'Model');
/**
 * FaqCategory Model
 *
 * @property User $User
 */
class FaqCategory extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required'
            )
        )
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
        public $hasMany = array(
		'Faq' => array(
			'className' => 'Faq',
			'foreignKey' => 'faq_category_id',
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
               'className'=>'FaqCategory',
               'foreignKey'=>'parent_id'
            )
                
		
	);
       
  public $belongsTo = array(
    'Parent'=>array(
       'className'=>'FaqCategory',
       'foreignKey'=>'parent_id'
    )
  );

}
