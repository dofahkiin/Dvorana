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
            'notEmpty' => array(
                'rule' => array('numeric'),
                'message' => 'Your custom message here',
                'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        )
    );

    public function getLimit()
    {
        return $this->Setting->find('all');
    }

}