<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Copy extends Entity{
	
	protected $_accessible = [
		'*' => true,
		'id' => false
	];
}