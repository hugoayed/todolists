<?php

namespace App\Controller;

use Cake\Filesystem\File;

// pour l'authentification :
//$ composer require "cakephp/authentication:^2.0"

class UsersController extends AppController {

	public function beforeFilter(\Cake\Event\EventInterface $event){
        parent::beforeFilter($event);

        //autorise l'affiche des actions index de TOUS les controllers même si on est pas connecté
        $this->Authentication->addUnauthenticatedActions(['login','new']);
    }
	
	public function index(){

		$this->viewBuilder()->setLayout('custom');

		//récup toutes les lignes de la table
		$u = $this->Users->find('all');

		//transmet la variable à la vue
		$this->set(compact('u'));
	}

	public function new(){

		$this->viewBuilder()->setLayout('custom');

		$new = $this->Users->newEmptyEntity();

		if($this->request->is(['post', 'put'])){
			//on recup les données du form
			//puisqu'on gere des fichiers, on passe nos elements a la main plutot que faire le patch (qui plante pour les fichier)
			$new->username = $this->request->getData('username');
			$new->password = $this->request->getData('password');

			if(!empty($this->request->getData('avatar')->getClientFilename())){
				//si le fichier n'est pas au bon format
				if(empty($this->request->getData('avatar')->getClientFilename()) || 
					!in_array($this->request->getData('avatar')->getClientMediaType(), ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {
					//erreur
					$this->Flash->error('L\'image est obligatoire et doit être au format png, jpg ou gif.');
				}else { //sinon (ok)

					//on recup l'extension du fichier
					$ext = pathinfo($this->request->getData('avatar')->getClientFilename(),PATHINFO_EXTENSION);
					
					//on  créé un nouveau nom pour le fichier
					$newName = 'avatar-'.time().'-'.rand(0,9999999).'.'.$ext;

					//on place ce nouveau nom dans l'entité
					$new->avatar = $newName;

					
				}
			}

			//on tente la sauvegarde de l'entité
			if($this->Users->save($new) ){
				//on déplace le fichier de la mémoire temporaire vers le dossier data
				if(!empty($this->request->getData('avatar')->getClientFilename()))
					$this->request->getData('avatar')->moveTo(WWW_ROOT.'img/data/avatars/'.$newName);
				//confirmation
				$this->Flash->success('Compte créé');
				//redirection
				return $this->redirect(['controller' => 'Users', 'action' => 'login']);
			} else {//sinon (pas sauvegardé)
				//erreur
				$this->Flash->error('Une erreur est survenue dans la création de votre compte. Réessayez.');
			}
		}

		$this->set(compact('new'));

	}

	public function login(){

		$this->viewBuilder()->setLayout('custom');

		if($this->request->is(['post'])){

			$res = $this->Authentication->getResult();

			if($res->isValid()){
				$this->Flash->success('Vous êtes connecté');
				return $this->redirect([
					'controller' => 'Todolists',
					'action' => 'index'
				]);
			} else {
				$this->Flash->error('Identifiants incorrects');
			}
		}
	}

	public function logout(){
		$result = $this->Authentication->getResult();
		$this->Authentication->logout();
		$this->Flash->success('Vous êtes déconnecté');
		return $this->redirect(['action' => 'login']);
	}

	public function update($id = null){

		$this->viewBuilder()->setLayout('custom');
		
		if(empty($id))
			return $this->redirect(['action' => 'index']);

		$user = $this->Users->findById($id);

		if($user->isEmpty()){
			$this->Flash->error('Cet compte n\'existe pas');
			return $this->redirect(['action' => 'index']);
		}

		$user = $user->first();

		//stocker le nom d'avatar
		$oldAvatar = $user->avatar;

		if($this->request->is(['post', 'put', 'patch'])){

			$user->username = $this->request->getData('username');

			//le champ MDP est vide par défaut, on change en BDD que s'il y a modification
			if(!empty($this->request->getData('newpassword'))){
				$user->password = $this->request->getData('newpassword');
			}			

			if(!empty($this->request->getData('newavatar')->getClientFilename())){

				//on recup l'extension du fichier
				$ext = pathinfo($this->request->getData('newavatar')->getClientFilename(), PATHINFO_EXTENSION);

				//on  créé un nouveau nom pour le fichier
				$newName = 'avatar-'.time().'-'.rand(0,9999999).'.'.$ext;

				if(!in_array($this->request->getData('newavatar')->getClientMediaType(), ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {
					$this->Flash->error('L\'image n\'est pas au format png, jpg ou gif.');
				} else {
					$user->avatar = $newName;
				}
			}

			if($this->Users->save($user)){

				if(!empty($this->request->getData('newavatar')->getClientFilename()) && 
					in_array($this->request->getData('newavatar')->getClientMediaType(), ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])){

					//on déplace le fichier de la mémoire temporaire vers le dossier data
					$this->request->getData('newavatar')->moveTo(WWW_ROOT.'img/data/avatars/'.$newName);

					//On supprime l'ancien avatar
					$file = new File(WWW_ROOT.'img/data/avatars/'.$oldAvatar);
					$file->delete();
				}
				
				//confirmation
				$this->Flash->success('Compte modifié');

				//redirection
				return $this->redirect(['controller' => 'Users', 'action' => 'update', $user->id]);
			} else {//sinon (pas sauvegardé)
				//erreur
				$this->Flash->error('Une erreur est survenue dans la modification de votre compte. Réessayez.');
			}
			
		}

		$this->set(compact(['user', 'oldAvatar']));
	}

	public function delete($id = null){
		$this->request->allowMethod(['post', 'delete']);
		
		$u = $this->Users->get($id);

		if($this->Users->delete($u)){
			$this->Flash->success('User supprimé');
		} else{
			$this->Flash->error('suppression impossible');
		}

		return $this->redirect(['action' => 'logout']);
	}
}