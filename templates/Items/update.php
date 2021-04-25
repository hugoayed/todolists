<?= $this->Html->css('custom') ?>

<section>
	<h1 class="title">Modifier un item</h1>

	<div class="form-update-item">
		<?php

			echo $this->Form->create($item);

				echo $this->Form->hidden('todolist_id', ['value' => $item->todolist_id]);

				echo $this->Form->control('content', ['label' => 'Nom de la tâche']);
				echo $this->Form->control('deadline', ['type' => 'date', 'default' => null]);
				echo $this->Form->control('status', ['label' => 'Done', 'type' => 'checkbox']);


				echo $this->Form->button('Modifier');

			echo $this->Form->end();

		?>
	</div>
	
</section>



