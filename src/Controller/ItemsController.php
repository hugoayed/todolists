<?php 

namespace App\Controller;

class ItemsController extends AppController{

	public function index(){
		$i = $this->Items->find('all');

		$this->set(compact('i'));
	}

	public function new(){
		$new = $this->Items->newEmptyEntity();

		if($this->request->is('post')){
			$new = $this->Items->patchEntity($new, $this->request->getData());
			
			if($this->Items->save($new)){
				$this->Flash->success('Nouvelle tâche enregistrée');
			} else {
				$this->Flash->error('Impossible de sauvegarder la tâche');
			}
		}

		return $this->redirect([
			'controller' => 'Todolists', 
			'action' => 'show',
			$new->todolist_id
		]);
	}

	public function update($id = null){
		if(empty($id))
			return $this->redirect(['controller' => 'Todolists','action' => 'index']);

		$item = $this->Items->findById($id);

		if($item->isEmpty()){
			$this->Flash->error('Cet item n\'existe pas');
			return $this->redirect(['controller' => 'Todolists','action' => 'index']);
		}

		$item = $item->first();

		if($this->request->is(['post', 'put', 'patch'])){
			$this->Items->patchEntity($item, $this->request->getData());

			if($this->Items->save($item)){
				$this->Flash->success('Item modifié');
				return $this->redirect(['controller' => 'Todolists', 'action' => 'show', $item->todolist_id]);
			}
			$this->Flash->error('Impossible de modifier');
		}

		$this->set(compact(['item']));

	}

	public function delete($id = null){
		$this->request->allowMethod(['post', 'delete']);
		
		$item = $this->Items->get($id);

		if($this->Items->delete($item)){
			$this->Flash->success('Element supprimé');
		} else{
			$this->Flash->error('suppression impossible');
		}

		return $this->redirect([
			'controller' => 'Todolists', 
			'action' => 'index'
		]);
	}

}