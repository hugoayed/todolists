<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ItemsTable extends Table{
	public function initialize(array $c):void{
		parent::initialize($c);

		$this->addBehavior('Timestamp');

		$this->belongsTo('Todolists', [
			'foreignKey' => 'todolist_id',
			'joinType' => 'INNER'
		]);
	}

	public function validationDefault(Validator $v) : Validator{
		$v->maxLength('content', 100)
			-> notEmptyString('content');

		return $v;
	}
}