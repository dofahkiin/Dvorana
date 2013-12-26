<?php
App::uses('AppModel', 'Model');
/**
 * Term Model
 *
 */
class Term extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'client_id'),
        'Hall'
    );

    public function isOwnedBy($term, $user) {
        return $this->field('id', array('id' => $term, 'client_id' => $user)) === $term;
    }
}
