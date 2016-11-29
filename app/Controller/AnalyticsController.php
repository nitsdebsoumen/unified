<?php
App::uses('AppController', 'Controller');
/**
 * Analytics Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class AnalyticsController extends AppController 
{

public $components = array('Paginator','Session');

	public function admin_listing() 
	{	       
		$analytics = $this->Analytic->find('all');
    #$this->set(compact('sitemaps'));        
    $this->Analytic->recursive = 0;
    $this->set('analytics', $this->Paginator->paginate());   	    	
	}

	public function admin_add() 
	{	  
      if ($this->request->is('post'))
      {
     
			 if ($this->Analytic->save($this->request->data)) 
			    {
               $this->Session->setFlash(__('New post saved successfully to the database'));
               return $this->redirect(array('action' => 'listing'));
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
     
            if ($this->Analytic->save($this->request->data)) 
                {
                    $this->Session->setFlash(__('New post saved successfully to the database'));
                    return $this->redirect(array('action' => 'listing'));
                }
            
            else
            {
             
              $this->Session->setFlash('Unable to add user. Please, try again.');
             
            }
      }   

    else
      {
        $options=array('conditions'=>array('Analytic.id'=>$id));
        $this->request->data=$this->Analytic->find('first',$options);
      }
  }

    public function admin_delete($id=null) 
  { 
    $this->Analytic->id = $id;
    $this->request->onlyAllow('post','delete');
    if ($this->Analytic->delete()) {
      $this->Session->setFlash(__('The product has been deleted.'));
    } else {
      $this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
    }
      return $this->redirect(array('action' => 'listing'));
  }



	

}