<?php
App::uses('AppController', 'Controller');
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 20.12.13.
 * Time: 10.04
 */

class SettingsController extends AppController {

    public function index(){
        $this->set('setting', $this->Setting->findByName('limit'));
    }

    public function limit(){
//        $this->Setting->name = 'limit';
        $limit = $this->Setting->findByName('limit');
        $limitVal = $limit['Setting']['value'];
        echo json_encode(intval($limitVal));
        exit;
    }

    public function isAuthorized($user) {
        // All registered users can add posts
        if ($this->action === 'limit') {
            return true;
        }

        // The owner of a post can edit and delete it
        return parent::isAuthorized($user);
    }
}