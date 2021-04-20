<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $this->fetch('title') ?></title>
	<?= $this->Html->meta('icon') ?>

	<?= $this->Html->css('custom') ?>
</head>
<body>

	<header>
		<h1>
			<a href="<?= $this->Url->build('/') ?>"><span>Todo</span>Lists</a>
		</h1>
		<nav>
			<?= $this->Html->link('Accueil', ['controller' => 'Todolists', 'action' => 'index']) ?>
			<?= $this->Html->link('Créer un compte', ['controller' => 'Users', 'action' => 'new'], 
                ['class' => 'active']); ?>
		</nav>
	</header>
	
</body>
</html>