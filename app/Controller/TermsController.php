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

        if($this->isOwned($id) or $this->Auth->user('role') == 'Menadžer')
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

        $id = $_POST['id'];
        $this->Term->id = $id;
		if (!$this->Term->exists()) {
			throw new NotFoundException(__('Invalid term'));
		}

        if($this->isOwned($id) or $this->Auth->user('role') == 'Menadžer')
        {
            $this->Term->delete();
        }
		exit;
	}

    public function isAuthorized($user) {
        // All registered users can add posts
        if ($this->action === 'add' or $this->action === 'index'
            or $this->action === 'delete' or $this->action === 'view'
            or $this->action === 'edit' or $this->action === 'getEvents'
            or  $this->action === 'save' or  $this->action === 'otkazi'
            or  $this->action === 'owner') {
            return true;
        }

        // The owner of a post can edit and delete it
        return parent::isAuthorized($user);
    }

   public function isOwned($termId)
   {
       if ($this->Term->isOwnedBy($termId, $this->Auth->user('id'))) {
           return true;
       }

   }

    public function save (){
        date_default_timezone_set('Europe/Sarajevo');

        $id = $_POST['id'];
        $start = date('c',(int)$_POST['start']);
        $end = date('c',(int)$_POST['end']);

        if($id && $this->Term->exists($id))
        {
            $this->Term->read(null, $id);
            $this->Term->set(array(
                'start' => $start,
                'end' => $end,
                'date' => date("Y-m-d",strtotime($start)),
                'term' => date("G:i-", strtotime($start)) . date("G:i", strtotime($end)),
                'comment' => $_POST['body']
            ));
            $this->Term->save();
        }

        else
        {
            $this->request->data['Term']['client_id'] = $this->Auth->user('id');
            $this->request->data['Term']['status'] = "nepotvrđen";
            $this->request->data['Term']['start'] = $start;
            $this->request->data['Term']['end'] = $end;
            $this->request->data['Term']['date'] = date("Y-m-d", strtotime($start));
            $this->request->data['Term']['comment'] = $_POST['body'];
            $this->request->data['Term']['term'] = date("G:i-", strtotime($start)) . date("G:i", strtotime($end));
            if ($this->Term->save($this->request->data)) {
                $this->Session->setFlash(__('The term has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }

        }

        exit;

    }

    public function getEvents(){
        $options = array('order' => array('Terms.start' => 'desc'));
        $allTerms = $this->Term->find('all');
        $terms = array();
        foreach($allTerms as $row){
            $termArray['id'] = $row['Term']['id'];
            $termArray['title'] = "";
            $termArray['body'] = $row['Term']['comment'];
            $termArray['start'] = date('Y-m-d\TH:i', strtotime($row['Term']['start']));
            $termArray['end'] = date('Y-m-d\TH:i', strtotime($row['Term']['end']));
            $terms[] = $termArray;
        }
        echo json_encode($terms);
        exit;
    }

    public function move()
    {
        date_default_timezone_set('Europe/Sarajevo');
        $id=(int)$_POST['id'];
        if (!$this->Term->exists($id)) {
            exit;
        }

        $start = date('c',(int)$_POST['start']);
        $end = date('c',(int)$_POST['end']);

        $this->Term->read(null, $id);
        $this->Term->set(array(
            'start' => $start,
            'end' => $end,
            'date' => date("Y-m-d",strtotime($start)),
            'term' => date("G:i-", strtotime($start)) . date("G:i", strtotime($end))
        ));
        $this->Term->save();

        exit;
    }

    public function otkazi(){
        $id=(int)$_POST['id'];

        if (!$this->Term->exists($id)) {
            exit;
        }

        $this->Term->read(null, $id);
        $this->Term->set(array(
            'status' => 'otkazan'
        ));
        $this->Term->save();

        exit;
    }

    public function owner(){

        $id = $_POST['id'];
        $this->Term->id = $id;

        if($this->isOwned($id))
        {
            echo json_encode(array("owner" => true));
        }
        else
        {
            echo json_encode(array("owner" => false));
        }

        exit;


    }
}
