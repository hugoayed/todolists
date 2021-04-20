<h1>Ajouter une liste</h1>

<?php

	echo $this->Form->create($n, ['enctype' => 'multipart/form-data']);

		echo $this->Form->control('title');
		echo $this->Form->control('visibility', ['type' => 'radio', 'options' => ['0' => 'Privée', '1' => 'Publique']]);
		echo $this->Form->control('picture', ['label' => 'Photo', 'type' => 'file']);
		echo $this->Form->button('Créer');

	echo $this->Form->end();

?>