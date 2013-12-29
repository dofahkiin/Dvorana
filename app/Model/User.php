<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel
{

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Unos imena je obavezan',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'surname' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Unos prezimena je obavezan',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'username' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Unos korisničkog imena je obavezan',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
//        'password' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//                'message' => 'Unos lozinke je obavezan',
//                //'allowEmpty' => false,
//                //'required' => false,
//                //'last' => false, // Stop validation after this rule
//                //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
        'telephone' => array(
            'phone' => array(
                'rule' => array('phone', '/^[0-9-+()# ]{6,12}+$/'),
                'message' => 'Telefonski broj nije ispravan',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Email adresa nije ispravna',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('Menadžer', 'Klijent')),
                'message' => 'Molimo unesite tip korisnika',
                'allowEmpty' => false
            )
        )
    );

    public function beforeSave($options = array())
    {
//        if (isset($this->data[$this->alias]['password'])) {
//            $passwordHasher = new SimplePasswordHasher();
//            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
//        } else {
//            unset($this->data[$this->alias]['password']);
//        }
//        return true;

        if (!empty($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        } else {
            unset($this->data[$this->alias]['password']);
        }


    }
}
