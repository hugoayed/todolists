<?= $this->Html->css('custom') ?>

<section>
	<h1 class="title">Copier la liste</h1>

	<div class="form-update-list">
		<?php

			echo $this->Form->create($new, ['enctype' => 'multipart/form-data']);

				echo $this->Form->control('title', ['label' => 'Nom de la liste', 'value' => $tl->title]);
				echo $this->Form->control('visibility', ['type' => 'radio', 'options' => ['0' => 'Privée', '1' => 'Publique']]);
				echo $this->Form->control('picture', ['label' => 'Photo', 'type' => 'file']);
				echo $this->Form->button('Copier');

			echo $this->Form->end();

		?>
	</div>
	
</section>


