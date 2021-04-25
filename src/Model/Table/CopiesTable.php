<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CopiesTable extends Table{
	public function initialize(array $c):void{
		parent::initialize($c);

		$this->addBehavior('Timestamp');

		$this->belongsTo('Todolists', [
			'foreignKey' => 'origin_id',
			'joinType' => 'INNER'
		]);
	}

	public function validationDefault(Validator $v) : Validator{
		$v->notEmptyString('origin_id')
			->notEmptyString('newlist_id');

		return $v;
	}
}