<?php 

namespace App\Controller;

use Cake\Filesystem\File;

class TodolistsController extends AppController{

	public function beforeFilter(\Cake\Event\EventInterface $event){
        parent::beforeFilter($event);

        //autorise l'affiche des actions index de TOUS les controllers même si on est pas connecté
        $this->Authentication->addUnauthenticatedActions(['index']);
    }
	
	public function index(){
		//récup toutes les lignes de la table
		$tl = $this->Todolists->find('all');

		//récupère toutes les listes publiques
		$publicTl = $this->Todolists->find('all')->where(['visibility' => '1']);

		$new = $this->Todolists->newEmptyEntity();

		//transmet la variable à la vue
		$this->set(compact(['tl', 'publicTl']));
	}

	public function new(){
		//on créé une entity de liste vide 
		$n = $this->Todolists->newEmptyEntity();

		//si on est en POST
		if($this->request->is(['post', 'put'])){
			//récupéreration des données du form
			//puisqu'on gere des fichiers, on passe nos elements a la main plutot que faire le patch (qui plante pour les fichier)
			$n->title = $this->request->getData('title');
			$n->visibility = $this->request->getData('visibility');
			$n->user_id = $this->request->getAttribute('identity')->id;
			
			//si le fichier n'est pas au bon format
			if(empty($this->request->getData('picture')->getClientFilename()) || 
				!in_array($this->request->getData('picture')->getClientMediaType(), ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {
				$this->Flash->error('L\'image n\'est pas au format png, jpg ou gif.');
			} else {
				//on recup l'extension du fichier
				$ext = pathinfo($this->request->getData('picture')->getClientFilename(),PATHINFO_EXTENSION);

				//on  créé un nouveau nom pour le fichier
				$newName = 'pict-'.time().'-'.rand(0,9999999).'.'.$ext;

				//on place ce nouveau nom dans l'entité
				$n->picture = $newName;

				//on essaie de le sauvegarder
				if($this->Todolists->save($n)){
					//on déplace le fichier de la mémoire temporaire vers le dossier data
					$this->request->getData('picture')->moveTo(WWW_ROOT.'img/data/pictures/'.$newName);
					//confirmation
					$this->Flash->success('Todolist enregistrée');
					//redirige vers la page de la publication
					return $this->redirect([
						'controller' => 'Todolists',
						'action' => 'index'
					]);
				} else //sinon erreur
					$this->Flash->error('Sauvegarde de la liste impossible');
			}


			
		}//fin du test mode

		$this->set(compact('n'));
		
	}

	public function show($id = null){

		//si id est vide, on va vers accueil
		if(empty($id))
			return $this->redirect(['action' => 'index']);

		//find() donne un ensemble de résultats
		//pour avoir le premier résultat, on applique la méthode first()
		$tl = $this->Todolists->findById($id)->contain(['Items']);

		//s'il n'y a pas de publication avec cet id
		//le ->isEmpty ne s'applique que sur les objets query (find())
		if($tl->isEmpty()){
			$this->Flash->error('Cette liste n\'existe pas');
			return $this->redirect(['action' => 'index']);
		}

		$tl = $tl->first();

		//on charge le modele pour pouvoir lui créer une entité
		$this->loadModel('Items');
		$newItem = $this->Todolists->newEmptyEntity();
		$this->set(compact(['newItem', 'tl']));

		//on récupère l'id du l'utilisateur connecté et celui du créateur de la liste
		$id_user_connected = $this->request->getAttribute('identity')->id;

		//si l'id du createur de la liste est différent de celui de l'utilisateur connecté ET que la liste est privée
		if($tl->user_id != $id_user_connected && $tl->visibility == 0){
			//affiche un msg d'accès impossible et redirige vers l'index
			$this->Flash->error('Vous n\'avez pas accès à cette liste');
			$this->redirect(['action' => 'index']);
		}

	}

	public function byuser($id = null){

		// if($id != $this->request->getAttribute('identity')->id){
		// 	$this->Flash->error('Vous n\'avez pas accès aux listes de cet utilisateur');
		// 	return $this->redirect(['action' => 'index']);
		// }

		if(empty($id))
			return $this->redirect(['action' => 'index']);
		$tl = $this->Todolists->findByUser_id($id)->contain('Items');

		$this->set(compact(['tl', 'id']));
	}

	public function update($id = null){
		if(empty($id))
			return $this->redirect(['action' => 'index']);

		$tl = $this->Todolists->findById($id);

		if($tl->isEmpty()){
			$this->Flash->error('Cette liste n\'existe pas');
			return $this->redirect(['action' => 'index']);
		}

		$tl = $tl->first();

		$oldPicture = $tl->picture;

		if($this->request->is(['post', 'put', 'patch'])){

			$tl->title = $this->request->getData('title');
			$tl->visibility = $this->request->getData('visibility');

			if(!empty($this->request->getData('newPicture')->getClientFilename())){
				//on recup l'extension du fichier
				$ext = pathinfo($this->request->getData('newPicture')->getClientFilename(), PATHINFO_EXTENSION);

				//on  créé un nouveau nom pour le fichier
				$newName = 'pict-'.time().'-'.rand(0,9999999).'.'.$ext;

				if(!in_array($this->request->getData('newPicture')->getClientMediaType(), ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {
					$this->Flash->error('L\'image n\'est pas au format png, jpg ou gif.');
					return $this->redirect(['action' => 'update', $id]);
				} else {
					$tl->picture = $newName;
				}
			}

			if($this->Todolists->save($tl)){

				if(!empty($this->request->getData('newPicture')->getClientFilename()) && 
					in_array($this->request->getData('newPicture')->getClientMediaType(), ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])){

					//on déplace le fichier de la mémoire temporaire vers le dossier data
					$this->request->getData('newPicture')->moveTo(WWW_ROOT.'img/data/pictures/'.$newName);

					//On supprime l'ancien avatar
					$file = new File(WWW_ROOT.'img/data/pictures/'.$oldPicture);
					$file->delete();
					
					// $this->Flash->success('Image modifiée');
				}

				$this->Flash->success('Liste modifiée');
				return $this->redirect(['action' => 'update', $id]);
			} else {
				$this->Flash->error('Impossible de modifier');
			}
		}

		$this->set(compact(['tl', 'oldPicture']));
	}

	public function delete($id = null){
		$this->request->allowMethod(['post', 'delete']);
		
		$tl = $this->Todolists->get($id);

		if($this->Todolists->delete($tl)){
			$this->Flash->success('Liste supprimée');
		} else{
			$this->Flash->error('suppression impossible');
		}

		return $this->redirect(['action' => 'index']);
	}

	public function updateId($id = null){

		if(empty($id))
			return $this->redirect(['controller' => 'Todolists','action' => 'index']);

		// $item = $this->Items->findById($id);

		$lists = $this->Todolists->find('all', ['contain' => ['Items.Todolists']]);

		// if($item->isEmpty()){
		// 	$this->Flash->error('Cet item n\'existe pas');
		// 	return $this->redirect(['controller' => 'Todolists','action' => 'index']);
		// }

		// $item = $item->first();

		// if($this->request->is(['post', 'put', 'patch'])){
		// 	$this->Items->patchEntity($item, $this->request->getData());

		// 	if($this->Items->save($item)){
		// 		$this->Flash->success('Item modifié');
		// 		return $this->redirect(['controller' => 'Todolists', 'action' => 'show', $item->todolist_id]);
		// 	}
		// 	$this->Flash->error('Impossible de modifier');
		// }

		$this->set(compact(['lists']));

		//on récupère l'id du l'utilisateur connecté et celui du créateur de la liste
		$id_user_connected = $this->request->getAttribute('identity')->id;

	}
}