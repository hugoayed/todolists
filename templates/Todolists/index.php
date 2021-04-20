<!-- <h1>Nb lists (<?= $tl->count() ?>):</h1> -->
<h1>Listes publiques de tous les utilisateurs (<?= $publicTl->count() ?>):</h1>

<?php foreach($tl as $todolist): ?>
	
	<?php if($todolist->visibility == 1 ): ?>
		<p><?= $this->Html->link($todolist->title, ['controller' => 'Todolists', 'action' => 'show', $todolist->id]) ?></p>
	<?php endif ?>

<?php endforeach ?>