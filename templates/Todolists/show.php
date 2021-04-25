<?= $this->Html->css('custom') ?>

<section>
	<h1 class="title"><?= $tl->title ?></h1>

	<div class="picture">
		<?php if(isset($tl->picture)): ?>
			<?= $this->Html->image('data/pictures/'.$tl->picture, ['alt' => $tl->title]) ?>
		<?php endif ?>
	</div>

	<div class="list-items">
		<h3>Tâches</h3>

		<?php foreach($tl->items as $item) : ?>
			<ul>
				<li class="item"><?= $item->content ?><?php if($item->deadline != null): ?>, deadline : <?= $item->deadline ?>. <?php else: ?>, pas de deadline.<?php endif ?></li>
			</ul>
			<p>

				<?php if($tl->user_id == $this->request->getAttribute('identity')->id): ?>
					<?= $this->Html->Link('Modifier', ['controller' => 'Items', 'action' => 'update', $item->id], ['class' => 'button']) ?> 
					<?= $this->Form->postLink('Supprimer', ['controller' => 'Items', 'action' => 'delete', $item->id], ['class' => 'button']) ?> 
				<?php endif ?>
			</p>

		<?php endforeach ?>
		<hr>

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
		<?php endif ?>

			<h3><?= $this->Html->Link('Copier la liste', ['controller' => 'Todolists', 'action' => 'copy', $tl->id], ['class' => 'button']) ?></h3>
		
		<?php if($tl->user_id == $this->request->getAttribute('identity')->id): ?>

			<h3><?= $this->HTml->link('Modifier la liste', ['controller' => 'Todolists', 'action' => 'update', $tl->id], ['class' => 'button']) ?></h3>

			<h3><?= $this->Form->postLink('Supprimer la liste', ['controller' => 'Todolists', 'action' => 'delete', $tl->id], ['class' => 'button', 'confirm' => 'Supprimer ?']) ?></h3>

		<?php endif ?>
	</div>
</section>