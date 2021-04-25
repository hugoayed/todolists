<?= $this->Html->css('custom') ?>

<section>
	<h1 class="title">Mon compte</h1>

	<div class="account-actions">
		<?= $this->Html->link('Mes listes', ['controller' => 'Todolists', 'action' => 'byuser', $this->request->getAttribute('identity')->id], ['class' => 'button']) ?>
		
		<?= $this->Html->link('Modifier mon compte', ['controller' => 'Users', 'action' => 'update', $this->request->getAttribute('identity')->id], ['class' => 'button']) ?>
		
		<?= $this->Form->postLink('Supprimer mon compte', ['controller' => 'Users', 'action' => 'delete', $this->request->getAttribute('identity')->id], ['class' => 'button', 'confirm' => 'Supprimer ?']) ?>
	</div>
	
</section>

