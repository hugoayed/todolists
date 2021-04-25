<?= $this->Html->css('custom') ?>

<section>
	<h1 class="title">Modifier la liste</h1>

	<div class="form-update-list">
		<?php

			echo $this->Form->create($tl, ['enctype' => 'multipart/form-data']);

				echo $this->Form->control('title', ['label' => '']);
				echo $this->Form->control('visibility', ['type' => 'radio', 'options' => ['0' => 'Privée', '1' => 'Publique']]);
				echo $this->Form->control('newPicture', ['label' => 'Photo', 'type' => 'file']);
				echo $this->Form->button('Modifier');

			echo $this->Form->end();

		?>
	</div>
	
</section>



