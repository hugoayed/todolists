<?= $this->Html->css('custom') ?>

<section>
	<h1 class="title">
		<?php if($tl->count() < 1 ): ?>
			<p>Il n'y a aucune liste pour le moment.</p>
			<?php else: ?>
			Listes de <?= $first->user->username ?> (<?= $tl->count() ?>)
		<?php endif ?>
	</h1>

	<div class="list-container">
		<?php foreach($tl as $todolist): ?>

			<?php if(!($todolist->visibility == 0 && ($todolist->user_id != $this->request->getAttribute('identity')->id))): ?>
				<div class="box-list">
					<p><?= $this->Html->link($todolist->title, ['controller' => 'Todolists', 'action' => 'show', $todolist->id]) ?></p>
						
					<?php if($todolist->items == null ): ?>
						<p class="no-item">
							Cette liste ne contient aucun élément.
						</p>
					<?php endif ?>

					<?php foreach($todolist->items as $item): ?>
						<p class="item"> <?= $item->content ?><?php if($item->deadline != null): ?>, deadline : <?= $item->deadline ?><?php endif ?></p>
					<?php endforeach ?>
				</div>
			<?php endif ?>

			
		<?php endforeach ?>
	</div>
	

</section>