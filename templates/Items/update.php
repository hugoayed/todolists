<h3>Modifier un item</h3>

<?php

	echo $this->Form->create($item);

		echo $this->Form->hidden('todolist_id', ['value' => $item->todolist_id]);

		echo $this->Form->control('content');
		echo $this->Form->control('deadline', ['type' => 'date', 'default' => null]);
		echo $this->Form->control('status', ['label' => 'Done', 'type' => 'checkbox']);


		echo $this->Form->button('Modifier');

	echo $this->Form->end();

?>