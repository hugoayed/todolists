<h1>Modifier une liste</h1>

<h2><?= $oldPicture ?></h2>

<?php

	echo $this->Form->create($tl, ['enctype' => 'multipart/form-data']);

		echo $this->Form->control('title');
		echo $this->Form->control('visibility', ['type' => 'radio', 'options' => ['0' => 'Privée', '1' => 'Publique']]);
		echo $this->Form->control('newPicture', ['label' => 'Photo', 'type' => 'file']);
		echo $this->Form->button('Modifier');

	echo $this->Form->end();

?>