<?php

App::uses('AppModel', 'Model');

/**
 * Job Model
 *
 * @property User $User
 * @property Bid $Bid
 * @property PostJob $PostJob
 */
class Post extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array();

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $hasMany = array(
        'PostImage' => array(
            'className' => 'PostImage',
            'foreignKey' => 'post_id',
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
        'Rating' => array(
            'className' => 'Rating',
            'foreignKey' => 'post_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        // 'CompanyDetail' => array(
        //     'className' => 'CompanyDetail',
        //     'foreignKey' => '',
        //     'conditions' => '',
        //     'fields' => '',
        //     'order' => ''
        // ),
        // 'CourseLocation' => array(
        //     'className' => 'UserCourseLocation',
        //     'foreignKey' => 'post_id',
        //     'conditions' => '',
        //     'fields' => '',
        //     'order' => ''
        // ),
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    public $hasAndBelongsToMany = array(
        'Skill' => array(
            'className' => 'Skill',
            'joinTable' => 'post_skills',
            'foreignKey' => 'post_id',
            'associationForeignKey' => 'skill_id'
        ),
        'CourseLocation' => array(
            'className' => 'CourseLocation',
            'joinTable' => 'user_course_locations',
            'foreignKey' => 'post_id',
            'associationForeignKey' => 'course_locations_id'
        )

    );

    public function csvImport($filename, $userid) {
        $handle = fopen($filename, "r");

        // read the 1st row as headings
        $header = fgetcsv($handle);

        // create a message container
        $return = array(
            'messages' => array(),
            'errors' => array(),
        );

        // read each data row in the file
        while (($row = fgetcsv($handle)) !== FALSE) {
            $i++;
            $data = array();
            $data['Post']['user_id'] = $userid;
            // for each header field
            foreach ($header as $k => $head) {
                // get the data field from Model.field
                if (strpos($head, '.') !== false) {

                    $h = explode('.', $head);
                    $data[$h[0]][$h[1]] = (isset($row[$k])) ? $row[$k] : '';

                } else {
                    $cskill = array();
                    $ccategory = array();
                    // get the data field from field
                    if ($head == 'skill') {
                        if(isset($row[$k]) && $row[$k] != '') {
                            $skills = explode(',', $row[$k]);

                            foreach($skills as $skill) {
                                $skill_condition = array(
                                    'Skill.skill_name LIKE ' => '%' . $skill . '%'
                                );
                                $check_skill = $this->Skill->find('first', array('conditions' => $skill_condition));

                                if(!empty($check_skill)) {
                                    $data['Skill']['Skill'][] = $check_skill['Skill']['id'];
                                } else {
                                    $cskill['Skill']['skill_name'] = trim($skill);
                                    $this->Skill->create();
                                    $this->Skill->save($cskill);
                                    $data['Skill']['Skill'][] = $this->Skill->getLastInsertId();
                                }
                            }
                        } else {
                            $data['Skill']['Skill'][] = array();
                        }
                    }
                    if ($head == 'category') {
                        if(isset($row[$k]) && $row[$k] != '') {

                            $cat_condition = array(
                                'Category.category_name LIKE ' => '%' . trim($row[$k]) . '%'
                            );
                            $check_cat = $this->Category->find('first', array('conditions' => $cat_condition));

                            if(!empty($check_cat)) {
                                $data['Post']['category_id'] = $check_cat['Category']['id'];
                            } else {
                                $ccategory['Category']['category_name'] = $row[$k];
                                $this->Category->create();
                                $this->Category->save($ccategory);
                                $data['Post']['category_id'] = $this->Category->getLastInsertId();
                            }

                        } else {
                            $data['Post']['category_id'][] = '';
                        }
                    } else {
                        $data['Post'][$head] = (isset($row[$k])) ? $row[$k] : '';
                    }


                }
            }


            // see if we have an id
            $id = isset($data['Post']['id']) ? $data['Post']['id'] : 0;

            // we have an id, so we update
            if ($id) {
                // there is 2 options here,
                // option 1:
                // load the current row, and merge it with the new data
                //$this->recursive = -1;
                //$post = $this->read(null,$id);
                //$data['Post'] = array_merge($post['Post'],$data['Post']);
                // option 2:
                // set the model id
                $this->id = $id;
            } else {
                // or create a new record
                $this->create();
            }

            // see what we have
            // debug($data);
            // validate the row
            $this->set($data);
            if (!$this->validates()) {
                //$this->_flash(, 'warning');
                $return['errors'][] = __(sprintf('Post for Row %d failed to validate.', $i), true);
            }

            // save the row
            if (!$this->save($data)) {
                $return['errors'][] = __(sprintf('Post for Row %d failed to save.', $i), true);
            }

            // success message!
            if (!$return['errors']) {
                $return['messages'] = __(sprintf('Post for Row %d was saved.', $i), true);
            }
        }

        // close the file
        fclose($handle);

        // return the messages
        return $return;
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['post_title']))
        {
            $this->data[$this->alias]['slug'] = $this->createSlug($this->data[$this->alias]['post_title']);
        }
        return true;
    }

}
