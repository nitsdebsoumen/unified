<?php

App::uses('AppController', 'Controller');

/**
 * Privacies Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Category->recursive = 0;
        $this->set('categories', $this->Paginator->paginate());
    }

    public function admin_index() {
        $this->loadModel('Country');
        $countries = $this->Country->find('list');
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        if (isset($this->request->data['keyword'])) {
            $keywords = $this->request->data['keyword'];
        } else {
            $keywords = '';
        }
        if (isset($this->request->data['search_is_active'])) {
            $Newsearch_is_active = $this->request->data['search_is_active'];
        } else {
            $Newsearch_is_active = '';
        }
        if (isset($this->request->data['Country'])) {
            $Country = $this->request->data['Country'];
        } else {
            $Country = '';
        }
        $QueryStr = '1';
        if ($keywords != '') {
            $QueryStr.=" AND (Category.category_name LIKE '%" . $keywords . "%')";
        }
        if ($Newsearch_is_active != '') {
            $QueryStr.=" AND (Category.status = '" . $Newsearch_is_active . "')";
        }
        if ($Country != '') {
            $QueryStr.=" AND (Category.country_id=" . $Country . ")";
        }
        $options = array('conditions' => array($QueryStr), 'order' => array('Category.category_name' => 'ASC'));

        $this->Paginator->settings = $options;
        $title_for_layout = 'Category List';
        $this->Category->recursive = 1;
        $this->set('categories', $this->Paginator->paginate('Category'));
        $this->set(compact('title_for_layout', 'countries', 'keywords', 'Newsearch_is_active', 'Country'));
    }

    public function admin_subcategories($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Sub Category List';
        $options = array('conditions' => array('Category.id' => $id));
        $categoryname = $this->Category->find('list', $options);
        if ($categoryname) {
            $categoryname = $categoryname[$id];
        } else {
            $categoryname = '';
        }
        //$this->Category->recursive = 0;
        $this->set('categories', $this->Paginator->paginate('Category', array('Category.parent_id' => $id)));
        $this->set(compact('title_for_layout', 'categoryname', 'id'));
    }

    public function admin_exportsub($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $categories = $this->Category->find('all');

        $output = '';
        $output .='Name, Status';
        $output .="\n";

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $isactive = ($category['Category']['active'] == 1 ? 'Active' : 'Inactive');

                $output .='"' . $category['Category']['name'] . '","' . $isactive . '"';
                $output .="\n";
            }
        }
        $filename = "categories" . time() . ".csv";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        echo $output;
        exit;
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->redirect('/admin');
        }
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Invalid Category'));
        }
        $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
        $this->set('category', $this->Category->find('first', $options));
    }

    public function admin_view($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Category View';
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Invalid Category'));
        }
        $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
        $category = $this->Category->find('first', $options);
        #pr($category);
        if ($category) {
            $options = array('conditions' => array('Category.id' => $category['Category']['parent_id']));
            $categoryname = $this->Category->find('list', $options);
            #pr($categoryname);
            if ($categoryname) {
                $categoryname = $category['Category']['category_name'];
            } else {
                $categoryname = '';
            }
        }
        $this->set(compact('title_for_layout', 'category', 'categoryname'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->redirect('/admin');
        }
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('The category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
            }
        }
        $users = $this->Category->User->find('list');
        $this->set(compact('users'));
    }

    public function admin_add() {
        $this->loadModel('CategoryImage');
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        $this->request->data1 = array();
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $countries = $this->Category->Country->find('list');
        $categories = $this->Category->find('list', array('fields' => array('Category.id', 'Category.category_name')));
        //print_r($country);
        $title_for_layout = 'Category Add';
        if ($this->request->is('post')) {
            $options = array('conditions' => array('Category.category_name' => $this->request->data['Category']['category_name']));
            $name = $this->Category->find('first', $options);
            if (!$name) {

                if (!empty($this->request->data['Category']['image']['name'])) {
                    $pathpart = pathinfo($this->request->data['Category']['image']['name']);
                    $ext = $pathpart['extension'];
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif', 'svg');
                    if (in_array(strtolower($ext), $extensionValid)) {
                        $uploadFolder = "img/cat_img";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = uniqid() . '.' . $ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($this->request->data['Category']['image']['tmp_name'], $full_flg_path);
                        $this->request->data1['CategoryImage']['originalpath'] = $filename;
                        $this->request->data1['CategoryImage']['resizepath'] = $filename;
                    } else {
                        $this->Session->setFlash(__('Invalid image type.'));
                        return $this->redirect(array('action' => 'index'));
                    }
                } else {
                    $filename = '';
                }
                $this->request->data['Category']['parent_id'] = $this->request->data['Category']['categories'] ? $this->request->data['Category']['categories'] : 0;
                $this->Category->create();
                if ($this->Category->save($this->request->data)) {
                    $this->request->data1['CategoryImage']['category_id'] = $this->Category->id;
                    //pr($this->request->data1);
                    //exit;
                    $this->CategoryImage->save($this->request->data1);
                    $this->Session->setFlash(__('The category has been saved.', 'default', array('class' => 'success')));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The category name already exists. Please, try again.'));
            }
        }
        $this->set(compact('parents', 'title_for_layout', 'countries', 'categories'));
    }

    public function admin_addsubcategory($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Sub Category Add';
        if ($this->request->is('post')) {
            $options = array('conditions' => array('Category.name' => $this->request->data['Category']['name'], 'Category.parent_id' => $this->request->data['Category']['parent_id']));
            $name = $this->Category->find('first', $options);
            if (!$name) {
                $this->Category->create();
                if ($this->Category->save($this->request->data)) {
                    $this->Session->setFlash(__('The sub category has been saved.'));
                    return $this->redirect(array('action' => 'subcategories', $id));
                } else {
                    $this->Session->setFlash(__('The sub category could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The sub category name already exists. Please, try again.'));
            }
        }
        $options = array('conditions' => array('Category.id' => $id));
        $categoryname = $this->Category->find('list', $options);
        if ($categoryname) {
            $categoryname = $categoryname[$id];
        } else {
            $categoryname = '';
        }
        $this->set(compact('title_for_layout', 'categoryname', 'id'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->redirect('/admin');
        }
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('The category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
            $this->request->data = $this->Category->find('first', $options);
        }
        $users = $this->Category->User->find('list');
        $this->set(compact('users'));
    }

    public function admin_edit($id = null) {
        $this->loadModel('CategoryImage');
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        $this->request->data1 = array();
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $countries = $this->Category->Country->find('list');
        $categories = $this->Category->find('list', array('fields' => array('Category.id', 'Category.category_name'), 'conditions' => array('Category.id <>' => $id)));
        //echo $id;exit;
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->request->is(array('post', 'put'))) {
            //echo "hello";exit;
            $options = array('conditions' => array('Category.category_name' => $this->request->data['Category']['category_name'], 'Category.id <>' => $id));
            $name = $this->Category->find('first', $options);

            if (!$name) {
                //echo "hello";exit;

                if (!empty($this->request->data['Category']['image']['name'])) {
                    $pathpart = pathinfo($this->request->data['Category']['image']['name']);
                    $ext = $pathpart['extension'];
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif', 'svg');
                    if (in_array(strtolower($ext), $extensionValid)) {
                        $uploadFolder = "img/cat_img";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = uniqid() . '.' . $ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($this->request->data['Category']['image']['tmp_name'], $full_flg_path);
                        $this->request->data1['CategoryImage']['originalpath'] = $filename;
                        $this->request->data1['CategoryImage']['resizepath'] = $filename;
                        $this->request->data1['CategoryImage']['id'] = $this->request->data['Category']['categoryimage_id'];
                        $this->request->data1['CategoryImage']['category_id'] = $id;
                        $this->CategoryImage->save($this->request->data1);
                    } else {
                        $this->Session->setFlash(__('Invalid image type.'));
                        return $this->redirect(array('action' => 'index'));
                    }
                } else {
                    $this->request->data['Category']['image'] = $this->request->data['Category']['hide_img'];
                }

                $this->request->data['Category']['parent_id'] = $this->request->data['Category']['categories'];
                if ($this->Category->save($this->request->data)) {
                    $this->Session->setFlash(__('The category has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The category already exists. Please, try again.'));
            }
        } else {
            //echo "hello";exit;
            $is_parent = $this->Category->find('count', array('conditions' => array('Category.parent_id' => 0, 'Category.id' => $id)));
            $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
            $this->request->data = $this->Category->find('first', $options);

            //print_r($this->request->data);
        }
        $this->set(compact('is_parent', 'countries', 'categories'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Category->delete()) {
            $this->Session->setFlash(__('The category has been deleted.'));
        } else {
            $this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function admin_delete($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->request->onlyAllow('post', 'delete');
        $options = array('conditions' => array('Category.parent_id' => $id));
        $cat = $this->Category->find('list', $options);
        #pr($cat);
        #exit;
        if ($cat) {
            foreach ($cat as $k => $v) {
                $options1 = array('conditions' => array('Category.parent_id' => $k));
                $subcat = $this->Category->find('list', $options1);
                if ($subcat) {
                    foreach ($subcat as $k1 => $v1) {
                        $this->Category->delete($k1);
                    }
                }
                $this->Category->delete($k);
            }
        }
        if ($this->Category->delete($id)) {
            $this->Session->setFlash(__('The category has been deleted.' ,'default', array(), 'good'));
        } else {
            $this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    ///////////////////////////////AK///////////
    public function admin_export() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $options = array('Category.id !=' => 0);
        $cats = $this->Category->find('all', array('conditions' => $options));
        $output = '';
        $output .='Category Name, Parent Name, Is Active';
        $output .="\n";
//pr($cats);exit;
        if (!empty($cats)) {
            foreach ($cats as $cat) {
                $isactive = ($cat['Category']['active'] == 1) ? 'Yes' : 'No';

                $output .='"' . $cat['Category']['name'] . '","' . $cat['Parent']['name'] . '","' . $isactive . '"';
                $output .="\n";
            }
        }
        $filename = "categories" . time() . ".csv";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        echo $output;
        exit;
    }

    //////////////////////////AK///////////////////////
}
