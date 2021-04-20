<?php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use ArrayObject;

class AvatarBehavior extends Behavior{
	
	//lorsqu'on supprime l'entité, son fichier pictures est supprimé du serveur
	public function beforeDelete(Event $event, EntityInterface $entity, ArrayObject $options){
		if(!empty($entity->avatar) && file_exists(WWW_ROOT.'img/data/avatars/'.$entity->avatar) )
			unlink(WWW_ROOT.'img/data/avatars/'.$entity->avatar);
	}
}