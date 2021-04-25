<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $this->fetch('title') ?></title>
	<?= $this->Html->meta('icon') ?>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

	<?= $this->Html->css(['custom']) ?>

	<?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>

	<header>
        <div class="nav-container">
            <nav class="navbar">
                <div class="navbar-left">
                    <h2 id="main-title"><a href="<?= $this->Url->build('/') ?>">TODOLists</a></h2>
                </div>

                <div class="navbar-right">
                    <?php if($this->request->getAttribute('identity') == null) :  ?>
                    	<?= $this->Html->link('Créer un compte', ['controller' => 'Users', 'action' => 'new']) ?>
                    	<?= $this->Html->link('Log in', ['controller' => 'Users', 'action' => 'login']) ?>
                    <?php else : ?>
                    	<?= $this->Html->link('Mon compte', ['controller' => 'Users', 'action' => 'index']) ?>
                    	<?= $this->Html->link('Ajouter une liste', ['controller' => 'Todolists', 'action' => 'new']) ?>
                    	<?= $this->Html->link('Log out', ['controller' => 'Users', 'action' => 'logout']); ?>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>



	<main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
</body>
</html>