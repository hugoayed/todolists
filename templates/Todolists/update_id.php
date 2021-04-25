<?= $this->Html->css('custom') ?>

<h3>Modifier un item</h3>

<?php foreach($lists as $tl): ?>
	<h4>TITRE LISTE: <?= $tl->title ?></h4>
	<?php foreach($tl->items as $item): ?>
		<p>TITRE ITEM: <?= $item->content ?></p>
	<?php endforeach ?>
	<hr>
<?php endforeach ?>