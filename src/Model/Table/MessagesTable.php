<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MessagesTable extends Table{
	public function initialize(array $c):void{
		parent::initialize($c);

		$this->addBehavior('Timestamp');

		$this->belongsTo('Users', [
			'foreignKey' => 'sender_id',
			'joinType' => 'INNER'
		]);

		$this->belongsTo('Users', [
			'foreignKey' => 'receiver_id',
			'joinType' => 'INNER'
		]);
	}

	public function validationDefault(Validator $v) : Validator{
		$v->maxLength('subject', 75)
			->notEmptyString('content');

		return $v;
	}
}