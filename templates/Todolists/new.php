<?= $this->Html->css('custom') ?>

<section>
	<h1 class="title">Ajouter une liste</h1>

	<div class="form-new-list">
		<?php

			echo $this->Form->create($n, ['enctype' => 'multipart/form-data']);

				echo $this->Form->control('title', ['label' => '', 'placeholder' => 'Nom de la liste']); ?>
				<div class="visibility"> 
					
					<?= $this->Form->control('visibility', ['label' => 'Visibilité', 'type' => 'radio', 
					'options' => ['0' => 'Privée', '1' => 'Publique']]) ?>
						
				</div> 
				
				<?php echo $this->Form->control('picture', ['label' => 'Photo', 'type' => 'file']);
				echo $this->Form->button('Créer');

			echo $this->Form->end();

		?>
		
	</div>
</section>


