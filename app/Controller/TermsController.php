<?php
App::uses('AppController', 'Controller');
/**
 * Terms Controller
 *
 * @property Term $Term
 * @property PaginatorComponent $Paginator
 */
class TermsController extends AppController {

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
		$this->Term->recursive = 0;
		$this->set('terms', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Term->exists($id)) {
			throw new NotFoundException(__('Invalid term'));
		}
		$options = array('conditions' => array('Term.' . $this->Term->primaryKey => $id));
		$this->set('term', $this->Term->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
            $this->request->data['Term']['client_id'] = $this->Auth->user('id');
            $this->request->data['Term']['status'] = "nepotvrđen";
			if ($this->Term->save($this->request->data)) {
				$this->Session->setFlash(__('The term has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The term could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Term->exists($id)) {
			throw new NotFoundException(__('Invalid term'));
		}

        if($this->isOwned() or $this->Auth->user('role') == 'Menadžer')
        {

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Term->save($this->request->data)) {
				$this->Session->setFlash(__('The term has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The term could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Term.' . $this->Term->primaryKey => $id));
			$this->request->data = $this->Term->find('first', $options);
		    }
        }

        else {
            $this->Session->setFlash(__('The term could not be edited.'));
            return $this->redirect(array('action' => 'index'));
        }
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Term->id = $id;
		if (!$this->Term->exists()) {
			throw new NotFoundException(__('Invalid term'));
		}

        if($this->isOwned() or $this->Auth->user('role') == 'Menadžer')
        {
            $this->request->onlyAllow('post', 'delete');
            if ($this->Term->delete()) {
                $this->Session->setFlash(__('The term has been deleted.'));
            } else {
                $this->Session->setFlash(__('The term could not be deleted. Please, try again.'));
            }
        }
        else {
            $this->Session->setFlash(__('The term could not be deleted.'));
        }


		return $this->redirect(array('action' => 'index'));
	}

    public function isAuthorized($user) {
        // All registered users can add posts
        if ($this->action === 'add' or $this->action === 'index'
            or $this->action === 'delete' or $this->action === 'view'
            or $this->action === 'edit' ) {
            return true;
        }

        // The owner of a post can edit and delete it
        return parent::isAuthorized($user);
    }

   public function isOwned()
   {
       $termId = $this->request->params['pass'][0];
       if ($this->Term->isOwnedBy($termId, $this->Auth->user('id'))) {
           return true;
       }

   }

    public function save (){
        return true;

    }

    public function getEvents(){
        pr("Hello");
    }

}
