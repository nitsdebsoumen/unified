<?php
App::uses('AppController', 'Controller');
/**
 * Seourls Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class SeourlsController extends AppController 
{

public $components = array('Paginator','Session');

	public function admin_index() 
	{	       
		$seourls = $this->Seourl->find('all');
    #$this->set(compact('sitemaps'));        
    $this->Seourl->recursive = 0;
    $this->set('seourls', $this->Paginator->paginate());   	    	
	}

	public function admin_add() 
	{	  
      if ($this->request->is('post'))
      {
     
			 if ($this->Seourl->save($this->request->data)) 
			    {
               $this->Session->setFlash(__('New post saved successfully to the database'));
               return $this->redirect(array('action' => 'index'));
          }
            else
            {
             
              $this->Session->setFlash('Unable to add user. Please, try again.');
             
        	  }
      }  	

	}

  public function admin_edit($id=null) 
  {     
      
    if ($this->request->is(array('post','put')))
      {
     
            if ($this->Seourl->save($this->request->data)) 
                {
                    $this->Session->setFlash(__('New post saved successfully to the database'));
                    return $this->redirect(array('action' => 'index'));
                }
            
            else
            {
             
              $this->Session->setFlash('Unable to add user. Please, try again.');
             
            }
      }   

    else
      {
        $options=array('conditions'=>array('Seourl.id'=>$id));
        $this->request->data=$this->Seourl->find('first',$options);
      }
  }

    public function admin_delete($id=null) 
  { 
    $this->Seourl->id = $id;
    $this->request->onlyAllow('post','delete');
    if ($this->Seourl->delete()) {
      $this->Session->setFlash(__('The product has been deleted.'));
    } else {
      $this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
    }
      return $this->redirect(array('action' => 'index'));
  }



	

}