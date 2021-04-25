<?= $this->Html->css('custom') ?>

<section>
	<h1 class="title">Connexion</h1>

	<div class="form-login">
		<?php

			echo $this->Form->create();

				echo $this->Form->control('username', ['label' => '', 'placeholder' => 'Nom d\'utilisateur']);
				echo $this->Form->control('password', ['label' => '', 'placeholder' => 'Mot de passe']);

				echo $this->Form->button('Se connecter');

			echo $this->Form->end();

		?>
	</div>
</section>
