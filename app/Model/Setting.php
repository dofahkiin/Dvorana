<?php
App::uses('AppModel', 'Model');
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 20.12.13.
 * Time: 10.17
 */

class Setting extends AppModel
{

    public $displayField = 'name';
    public $primaryKey = 'name';

    public $validate = array(
        'value' => array(
            'Prazno' => array(
                'rule'    => 'notEmpty',
                'message' => 'Unesite limit'),
            'Brojevi' => array(
                'rule'     => 'numeric',
                'message'  => 'Samo brojevi'
            )));

    public function getLimit()
    {
        return $this->Setting->find('all');
    }

}