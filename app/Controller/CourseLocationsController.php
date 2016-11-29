<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class CourseLocationsController extends AppController {


    public function add()
    {

        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '')
        {
            $this->Session->setFlash(__('Please login to access profile.', 'default', array('class' => 'error')));
            return  $this->redirect('/');
        }

        $this->loadModel('User');
        $title_for_layout = 'Add Course Location';
        $countries = $this->CourseLocation->Country->find('list');

        $this->request->data['CourseLocation']['user_id'] = $userid;

        if ($this->request->is('post'))
        {

                //pr($this->request->data); exit;
                $this->CourseLocation->create();
                if ($this->CourseLocation->save($this->request->data))
                {
                    $this->Session->setFlash('The Course location has been saved.', 'default', array('class' => 'success'));
                }
                else
                {
                    $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
                }
               $this->redirect(array('action' => 'add'));
        }


        $option = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
        $userDetails = $this->User->find('first', $option);


        $states = $this->CourseLocation->State->find('list', array('fields' => array('State.id', 'State.name'), 'conditions' => array('State.country_id' => $userDetails['User']['country'])));
        $cities = $this->CourseLocation->City->find('list', array('fields' => array('City.id', 'City.name'), 'conditions' => array('City.state_id' => $userDetails['User']['state'])));
        $lgas = $this->CourseLocation->Lga->find('list', array('fields' => array('Lga.id', 'Lga.local_name')));


        $this->set(compact('countries','states','cities','lgas'));

    }

    public function admin_add($id = NULL){

        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if(!isset($is_admin) && $is_admin==''){
           $this->redirect('/admin');
        }

        $user_id = $id;

        $this->loadModel('User');
        $title_for_layout = 'Add Course Location';
        $countries = $this->CourseLocation->Country->find('list');

        $this->request->data['CourseLocation']['user_id'] = $user_id;

        if ($this->request->is('post'))
        {

                //pr($this->request->data); exit;
                $this->CourseLocation->create();
                if ($this->CourseLocation->save($this->request->data))
                {
                    $this->Session->setFlash(__('The Course location has been saved.', 'default', array('class' => 'success')));
                }
                else
                {
                    $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
                }
               $this->redirect(array('controller'=>'post','action' => 'add'));
        }


        $option = array('conditions' => array('User.' . $this->User->primaryKey => $user_id));
        $userDetails = $this->User->find('first', $option);


        $states = $this->CourseLocation->State->find('list', array('fields' => array('State.id', 'State.name'), 'conditions' => array('State.country_id' => $userDetails['User']['country'])));
        $cities = $this->CourseLocation->City->find('list', array('fields' => array('City.id', 'City.name'), 'conditions' => array('City.state_id' => $userDetails['User']['state'])));
        $lgas = $this->CourseLocation->Lga->find('list', array('fields' => array('Lga.id', 'Lga.local_name')));


        $this->set(compact('countries','states','cities','lgas'));

    }

    public function ajaxLocationOnLoad(){
        $data = array();
        $html='';
        $this->loadModel('Post');
        $this->loadModel('CourseLocation');
        $userid = $this->request->data['user_id'];
        $locations = $this->CourseLocation->find('list', array('fields' => array('CourseLocation.id', 'CourseLocation.address'),'conditions' => array('CourseLocation.user_id' => $userid)));
        if(!empty($locations)){
            foreach ($locations as $key => $location) {
                $html .='<option value='.$key.'>'.$location.'</option>';
                
            }
            $data['ack'] = 1;
            $data['res'] = $html;
        }
        else{
            $html .= "<option value=''>--select location--</option>";
            $data['ack'] = 0;
            $data['res'] = $html;
        }    
        echo json_encode($data);
        exit;
    }
    public function ajaxLocationOnChange(){
        $data = array();
        $html ='';
        $html1='';
        $this->loadModel('Post');
        $this->loadModel('CourseLocation');
        $userid = $this->request->data['user_id'];
        $locations = $this->CourseLocation->find('list', array('fields' => array('CourseLocation.id', 'CourseLocation.address'),'conditions' => array('CourseLocation.user_id' => $userid)));
        if(!empty($locations)){
            foreach ($locations as $key => $location) {
                $html .='<option value="'.$key.'">'.$location.'</option>';
                $html1 .='<span class="fstResultItem">'.$location.'</span>';
                
            }
            $data['ack'] = 1;
            $data['res'] = $html;
            $data['html1'] = $html1;
        }
        else{
            $html .= "<option value=''>--select location--</option>";
            $data['ack'] = 0;
            $data['res'] = $html;
        }    
        echo json_encode($data);
        exit;
    }




}


?>