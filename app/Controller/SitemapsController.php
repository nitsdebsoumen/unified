<?php
App::uses('AppController', 'Controller');
/**
 * Sitemaps Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class SitemapsController extends AppController 
{

public $components = array('Paginator','Session');

	public function admin_listing() 
	{	       
		$sitemaps = $this->Sitemap->find('all');
		#$this->set(compact('sitemaps'));    	   
    $this->Sitemap->recursive = 0;
    $this->set('sitemaps', $this->Paginator->paginate()); 	
	}

	public function admin_add() 
	{	  
      if ($this->request->is('post'))
      {
     
			 if ($this->Sitemap->save($this->request->data)) 
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
     
            if ($this->Sitemap->save($this->request->data)) 
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
        $options=array('conditions'=>array('Sitemap.id'=>$id));
        $this->request->data=$this->Sitemap->find('first',$options);
      }
  }

    public function admin_delete($id=null) 
  { 
    $this->Sitemap->id = $id;
    $this->request->onlyAllow('post','delete');
    if ($this->Sitemap->delete()) {
      $this->Session->setFlash(__('The product has been deleted.'));
    } else {
      $this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
    }
      return $this->redirect(array('action' => 'listing'));
  }



	

}