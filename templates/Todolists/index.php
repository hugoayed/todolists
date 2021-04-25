<?= $this->Html->css('custom') ?>

<section>
	<h1 class="title">Liste<?php if($publicTl->count() > 1 ): ?>s <?php endif ?> publique<?php if($publicTl->count() > 1 ): ?>s <?php endif ?>(<?= $publicTl->count() ?>) </h1>

	<div class="list-container">
		<?php if($publicTl->count() < 1 ): ?>
			<p>Il n'y a aucune liste publique pour le moment.</p>
		<?php endif ?>

		<?php foreach($tl as $todolist): ?>

			
			
				<?php if($todolist->visibility == 1 ): ?>
					<div class="box-list">
						<h3><?= $this->Html->link($todolist->title, ['controller' => 'Todolists', 'action' => 'show', $todolist->id]) ?></h3>

						<?php if($todolist->items == null ): ?>
							<p class="no-item">
								Cette liste ne contient aucun élément
							</p>
						<?php endif ?>

						<?php foreach($todolist->items as $item): ?>

							<p class="item"> <?= $item->content ?> </p>

						<?php endforeach ?>
					
						<p>Liste créée par : <?= $this->Html->link($todolist->user->username, ['controller' => 'Todolists', 'action' => 'byuser', $todolist->user_id]) ?> </p>

						
					</div>
					
				<?php endif ?>

				

		<?php endforeach ?>
	</div>

	
</section>
