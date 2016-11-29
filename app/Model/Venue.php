<?php

App::uses('AppModel', 'Model');

/**
 * Seo Model
 *
 */
class Venue extends AppModel {

    public $validate = array();

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'post_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
        // 'Event' => array(
        //     'className' => 'Event',
        //     'foreignKey' => 'event_id',
        //     'conditions' => '',
        //     'fields' => '',
        //     'order' => ''
        // ),
    );
    public $hasAndBelongsToMany = array(
        'Event' => array(
            'className' => 'Event',
            'joinTable' => 'venue_events',
            'foreignKey' => 'venue_id',
            'associationForeignKey' => 'event_id'
        ),
        'Facility' => array(
            'className' => 'Facility',
            'joinTable' => 'venue_facilities',
            'foreignKey' => 'venue_id',
            'associationForeignKey' => 'facility_id'
        ),
    );
    public $hasMany = array(
        'VenueImage' => array(
            'className' => 'VenueImage',
            'foreignKey' => 'venue_id',
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
            $data['Venue']['user_id'] = $userid;
            // for each header field 
            foreach ($header as $k => $head) {
                // get the data field from Model.field
                if (strpos($head, '.') !== false) {
                    
                    $h = explode('.', $head);
                    $data[$h[0]][$h[1]] = (isset($row[$k])) ? $row[$k] : '';
                    
                } else {
                    $cevent = array();
                    $cfacility = array();
                    $ccategory = array();
                    // get the data field from field
                    if ($head == 'Type of Events') {
                        if(isset($row[$k]) && $row[$k] != '') {
                            $events = explode(',', $row[$k]);
                            
                            foreach($events as $event) {
                                $event_condition = array(
                                    'Event.event_name LIKE ' => '%' . $event . '%'
                                );
                                $check_event = $this->Event->find('first', array('conditions' => $event_condition));
                                
                                if(!empty($check_event)) {
                                    $data['Event']['Event'][] = $check_event['Event']['id'];
                                } else {
                                    $cevent['Event']['event_name'] = trim($event);
                                    $this->Event->create();
                                    $this->Event->save($cevent);
                                    $data['Event']['Event'][] = $this->Event->getLastInsertId();
                                }
                            }
                        } else {
                            $data['Event']['Event'][] = array();
                        }
                    }
                    if ($head == 'Facilities') {
                        if(isset($row[$k]) && $row[$k] != '') {
                            $facilities = explode(',', $row[$k]);
                            
                            foreach($facilities as $facility) {
                                $facility_condition = array(
                                    'Facility.facility_name LIKE ' => '%' . $facility . '%'
                                );
                                $check_facility = $this->Facility->find('first', array('conditions' => $facility_condition));
                                
                                if(!empty($check_facility)) {
                                    $data['Facility']['Facility'][] = $check_facility['Facility']['id'];
                                } else {
                                    $cfacility['Facility']['event_name'] = trim($facility);
                                    $this->Facility->create();
                                    $this->Facility->save($cfacility);
                                    $data['Facility']['Facility'][] = $this->Facility->getLastInsertId();
                                }
                            }
                        } else {
                            $data['Facility']['Facility'][] = array();
                            }
                    } //if ($head == 'category') {
                    //     if(isset($row[$k]) && $row[$k] != '') {
                            
                    //         $cat_condition = array(
                    //             'Category.category_name LIKE ' => '%' . trim($row[$k]) . '%'
                    //         );
                    //         $check_cat = $this->Category->find('first', array('conditions' => $cat_condition));

                    //         if(!empty($check_cat)) {
                    //             $data['Post']['category_id'] = $check_cat['Category']['id'];
                    //         } else {
                    //             $ccategory['Category']['category_name'] = $row[$k];
                    //             $this->Category->create();
                    //             $this->Category->save($ccategory);
                    //             $data['Post']['category_id'] = $this->Category->getLastInsertId();
                    //         }
                            
                    //     } else {
                    //         $data['Post']['category_id'][] = '';
                    //     }
                    // } 
                        else {
                        $data['Venue'][$head] = (isset($row[$k])) ? $row[$k] : '';
                    }
                    
                    
                }
            }
            

            // see if we have an id             
            $id = isset($data['Venue']['id']) ? $data['Venue']['id'] : 0;

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
                $return['errors'][] = __(sprintf('Venue for Row %d failed to validate.', $i), true);
            }

            // save the row
            if(!empty($data['Venue']['venue_name'])){
                if (!$this->save($data)) {
                    $return['errors'][] = __(sprintf('Venue for Row %d failed to save.', $i), true);
                }
            }    

            // success message!
            if (!$return['errors']) {
                $return['messages'] = __(sprintf('Venue for Row %d was saved.', $i), true);
            }
        }

        // close the file
        fclose($handle);

        // return the messages
        return $return;
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['venue_name'])) 
        {
            $this->data[$this->alias]['slug'] = $this->createSlug($this->data[$this->alias]['venue_name']);
        }
        return true;
    }
}
