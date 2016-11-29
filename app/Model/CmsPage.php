<?php
App::uses('AppModel', 'Model');
/**
 * SiteSetting Model
 *
 * @property User $User
 */
class CmsPage extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
	);

	public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['title'])) 
        {
            $this->data[$this->alias]['slug'] = $this->create_slug($this->data[$this->alias]['title']);
        }
        return true;
    }

}
