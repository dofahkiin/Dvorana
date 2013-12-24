<?php
App::uses('AppController', 'Controller');
/**
 * Terms Controller
 *
 * @property Term $Term
 * @property PaginatorComponent $Paginator
 */
class TermsController extends AppController
{

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
    public function index()
    {
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
    public function view($id = null)
    {
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
    public function add()
    {
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
    public function edit($id = null)
    {
        if (!$this->Term->exists($id)) {
            throw new NotFoundException(__('Invalid term'));
        }

        if ($this->isOwned($id) or $this->Auth->user('role') == 'Menadžer') {

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
        } else {
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
    public function delete($id = null)
    {

        $id = $_POST['id'];
        $this->Term->id = $id;
        if (!$this->Term->exists()) {
            throw new NotFoundException(__('Invalid term'));
        }

        if ($this->isOwned($id) or $this->Auth->user('role') == 'Menadžer') {
            $this->Term->delete();
        }
        exit;
    }

    public function isAuthorized($user)
    {
        // All registered users can add posts
        if (in_array($this->action, array(
            'add', 'index', 'delete', 'view', 'edit', 'getEvents',
            'save', 'otkazi', 'owner', 'move', 'izvjestaj'))
        ) {
            return true;
        }

        // The owner of a term can edit and delete it
        return parent::isAuthorized($user);
    }

    public function isOwned($termId)
    {
        if ($this->Term->isOwnedBy($termId, $this->Auth->user('id'))) {
            return true;
        } else
            return false;

    }

    public function save()
    {
        date_default_timezone_set('Europe/Sarajevo');

        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
        }

        $start = date('c', (int)$_POST['start']);
        $end = date('c', (int)$_POST['end']);
        $status = $_POST['status'];

        if (isset($id) && $this->Term->exists($id)) {
            $this->Term->read(null, $id);
            $this->Term->set(array(
                'start' => $start,
                'end' => $end,
                'date' => date("Y-m-d", strtotime($start)),
                'term' => date("G:i-", strtotime($start)) . date("G:i", strtotime($end)),
                'comment' => $_POST['body'],
                'status' =>  $status
            ));
            $this->Term->save();
        } else {
            $this->request->data['Term']['client_id'] = $this->Auth->user('id');
            $this->request->data['Term']['status'] = $status;
            $this->request->data['Term']['start'] = $start;
            $this->request->data['Term']['end'] = $end;
            $this->request->data['Term']['date'] = date("Y-m-d", strtotime($start));
            $this->request->data['Term']['comment'] = $_POST['body'];
            $this->request->data['Term']['term'] = date("G:i-", strtotime($start)) . date("G:i", strtotime($end));
            $this->request->data['Term']['hall_id'] = intval($_POST['hall']);
            if ($this->Term->save($this->request->data)) {
                $term_id=$this->Term->getLastInsertId();
                echo json_encode(intval($term_id));
            }


        }

        exit;

    }

    public function getEvents()
    {
        $options = array('order' => array('Terms.start' => 'desc'));
        $allTerms = $this->Term->find('all');
        $terms = array();
        foreach ($allTerms as $row) {
            if($row['Term']['hall_id'] == $_REQUEST['hall'])
            {
                $termArray['id'] = $row['Term']['id'];
                $termArray['status'] =  $row['Term']['status'];
                $termArray['body'] = $row['Term']['comment'];
                $termArray['start'] = date('Y-m-d\TH:i', strtotime($row['Term']['start']));
                $termArray['end'] = date('Y-m-d\TH:i', strtotime($row['Term']['end']));
                $termArray['hall'] =  $row['Term']['hall_id'];
                $terms[] = $termArray;
            }
        }
        echo json_encode($terms);
        exit;
    }

    public function move()
    {
        date_default_timezone_set('Europe/Sarajevo');
        $id = (int)$_POST['id'];
        if (!$this->Term->exists($id)) {
            exit;
        }

        $start = date('c', (int)$_POST['start']);
        $end = date('c', (int)$_POST['end']);

        $this->Term->read(null, $id);
        $this->Term->set(array(
            'start' => $start,
            'end' => $end,
            'date' => date("Y-m-d", strtotime($start)),
            'term' => date("G:i-", strtotime($start)) . date("G:i", strtotime($end))
        ));
        $this->Term->save();

        exit;
    }

    public function otkazi()
    {
        $id = (int)$_POST['id'];

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

    public function owner()
    {

        $id = $_POST['id'];
        $this->Term->id = $id;

        $menadzer = ($this->Auth->user('role') == 'Menadžer');
        $own = $this->isOwned($id);

        echo json_encode(array("owner" => $own, "menadzer" => $menadzer));
        exit;
    }

    public function izvjestaj(){
        $this->Term->recursive = 0;

        if($this->Auth->user('role') == 'Klijent'){
            $this->Paginator->settings = array(
                'conditions' => array('Term.client_id' => $this->Auth->user('id')),
                'limit' => 10,
                'fields' => array('Term.id', 'Term.date', 'Term.term', 'Term.status','Term.hall_id', 'Term.comment', 'Term.price')
            );
            $data = $this->Paginator->paginate('Term');
            $this->set('terms', $data);
        }
        else {
            $this->set('terms', $this->Paginator->paginate());
        }
    }
}
