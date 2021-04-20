<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Todolist extends Entity{
	
	protected $_accessible = [
		'*' => true,
		'id' => false
	];
}