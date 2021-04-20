USER : <?php echo $id ?>

<?php foreach($tl as $todolist): ?>

	<!-- <p> <?= $todolist->title ?> </p> -->
	<p><?= $this->Html->link($todolist->title, ['controller' => 'Todolists', 'action' => 'show', $todolist->id]) ?></p>

<?php endforeach ?>