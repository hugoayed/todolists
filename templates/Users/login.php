<h1>Se connecter</h1>

<?php

	echo $this->Form->create();

		echo $this->Form->control('username', ['label' => 'Nom d\'utilisateur']);
		echo $this->Form->control('password', ['label' => 'Mot de passe']);

		echo $this->Form->button('Se connecter');

	echo $this->Form->end();

?>