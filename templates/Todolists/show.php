<h1><?= $tl->title ?></h1>

<h3>Les items</h3>

ici la liste de tous les items

<?php foreach($tl->items as $item) : ?>

	<p>
		<?= $item->content ?> ID: <?= $item->id ?> 

		<?php if($tl->user_id == $this->request->getAttribute('identity')->id): ?>
			<?= $this->Html->Link('Modifier', ['controller' => 'Items', 'action' => 'update', $item->id], ['class' => 'button']) ?> 
			<?= $this->Form->postLink('Supprimer', ['controller' => 'Items', 'action' => 'delete', $item->id], ['class' => 'button']) ?> 
		<?php endif ?>
	</p>

<?php endforeach ?>

<?php if($tl->user_id == $this->request->getAttribute('identity')->id): ?>

	<h3>Ajouter un item</h3>

	<?php

		echo $this->Form->create($newItem, ['url' => ['controller' => 'Items', 'action' => 'new']]);

			echo $this->Form->hidden('todolist_id', ['value' => $tl->id]);

			echo $this->Form->control('content');
			echo $this->Form->control('deadline', ['type' => 'date', 'default' => null]);
			echo $this->Form->control('status', ['label' => 'Done', 'type' => 'checkbox']);

			echo $this->Form->button('Créer item');

		echo $this->Form->end();

	?>

	<hr>

	<h3><?= $this->HTml->link('Modifier la liste', ['controller' => 'Todolists', 'action' => 'update', $tl->id], ['class' => 'button']) ?></h3>

	<h3><?= $this->Form->postLink('Supprimer la liste', ['controller' => 'Todolists', 'action' => 'delete', $tl->id], ['class' => 'button', 'confirm' => 'Supprimer ?']) ?></h3>

<?php endif ?>