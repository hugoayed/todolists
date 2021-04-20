<?= $this->Html->link('Mes listes', ['controller' => 'Todolists', 'action' => 'byuser', $this->request->getAttribute('identity')->id], ['class' => 'button']) ?>


<br>
<?= $this->Html->link('Modifier mon compte', ['controller' => 'Users', 'action' => 'update', $this->request->getAttribute('identity')->id], ['class' => 'button']) ?>

<br>
<?= $this->Form->postLink('Supprimer mon compte', ['controller' => 'Users', 'action' => 'delete', $this->request->getAttribute('identity')->id], ['class' => 'button', 'confirm' => 'Supprimer ?']) ?>