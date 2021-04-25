<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class TodolistsTable extends Table{
	public function initialize(array $c):void{
		parent::initialize($c);

		$this->addBehavior('Timestamp');

		$this->addBehavior('Image');

		$this->belongsTo('Users', [
			'foreignKey' => 'user_id',
			'joinType' => 'INNER'
		]);

		$this->hasMany('Items', [
			'foreignKey' => 'todolist_id',
			'joinType' => 'INNER',

			'dependent' => true, //supprime les items liés à une liste
			'cascadeCallbacks' => true
		]);

		$this->hasMany('Copies', [
			'foreignKey' => 'origin_id',
			'joinType' => 'INNER'
		]);
		
	}

	public function validationDefault(Validator $v) : Validator{
		$v->maxLength('title', 100)
			->notEmptyString('title')

			->notEmptyString('visibility')

			->notEmptyString('origin_id')

			->notEmptyString('newlist_id');
		return $v;
	}
}