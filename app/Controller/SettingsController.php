<?php
App::uses('AppController', 'Controller');
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 20.12.13.
 * Time: 10.04
 */

class SettingsController extends AppController
{
    public $helpers = array('Html', 'Form', 'Session', 'Js');
    public $components = array('Session', 'RequestHandler');

    public function index()
    {
        $this->set('setting', $this->Setting->findByName('limit'));
    }

    public function edit($name = null)
    {
        if ($this->request->is(array('post', 'put'))) {
            $this->Setting->read(null, $name);
            $this->Setting->set(array(
                'value' => $this->request->data['Setting']['value']
            ));
            $this->Setting->save();
//            $this->autoRender = $this->layout = false;
            $this->render('success', 'ajax');

        } else {
            $limit = $this->Setting->findByName($name);
            $this->request->data = $limit;
        }
    }

//    public function limit()
//    {
////        $this->Setting->name = 'limit';
//        $limit = $this->Setting->findByName('limit');
//        $limitVal = $limit['Setting']['value'];
//        $menadzer = ($this->Auth->user('role') == 'Menadžer');
//        echo json_encode(array("limit" => intval($limitVal), "menadzer" => $menadzer));
//        exit;
//    }

    public function isAuthorized($user)
    {
        // All registered users can add posts
        if ($this->action === 'limit') {
            return true;
        }

        // The owner of a post can edit and delete it
        return parent::isAuthorized($user);
    }

    public function validate_form()
    {
        if ($this->request->is('ajax')) {
            $this->request->data['Setting'][$this->request->data['name']] =  $this->request->data['value'];
            $this->Setting->set($this->request->data);
            if ($this->Setting->validates()) {
                $this->autoRender = FALSE;
            }
            else {
                $error = $this->validateErrors($this->Setting);
                $this->set('error', $error[$this->request->data['name']][0]);
            }
        }

    }
}