<?= $this->Html->css('custom') ?>

<section>
	<h1 class="title">Créer mon compte</h1>

	<div class="form-new-user">
		<?php

			echo $this->Form->create($new, ['enctype' => 'multipart/form-data']);

				echo $this->Form->control('username', ['label' => 'Nom d\'utilisateur']);
				echo $this->Form->control('password', ['label' => 'Mot de passe']);
				echo $this->Form->control('avatar', ['label' => 'Photo de profil', 'type' => 'file']);

				echo $this->Form->button('Créer mon compte');

			echo $this->Form->end();

		?>
	</div>
</section>



