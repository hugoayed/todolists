<h1>Modification de compte</h1>

<!-- <h2>OLD : <?= $oldAvatar ?></h2> -->

<?php

	echo $this->Form->create($user, ['enctype' => 'multipart/form-data']);

		echo $this->Form->control('username', ['label' => 'Nom d\'utilisateur']);
		echo $this->Form->control('newpassword', ['label' => 'Mot de passe', 'type' => 'password']);
		echo $this->Form->control('newavatar', ['label' => 'Photo de profil', 'type' => 'file']);

		echo $this->Form->button('Modifier mon compte');

	echo $this->Form->end();

?>