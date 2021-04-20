<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

class User extends Entity{

	protected $_accessible = [
		'*' => true,
		'id' => false
	];

	//on modifie le setter du mdp pour qu'il crypte automatiquement le password
	protected function _setPassword(string $p) : ?string{
		if(strlen($p) > 0){
			return (new DefaultPasswordHasher())->hash($p);
		}
	}
}