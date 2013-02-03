	<?php if( $deja_adoptes ) : ?>
		<div id="panier">
			<ul>
			<?php foreach($deja_adoptes as $prof) : ?>
				<li>
					<?php echo anchor('prof/liberer/' . $prof->prof_id, $prof->prenom, array('title' => 'Libérer ' . $prof->prenom . ' ' . $prof->prenom, 'hreflang' => 'fr')); ?>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

<a href="<?php echo site_url(); ?>">Retour à la page d'accueil</a>
	<h1>Adopte un prof - fiche de <?php echo $prof->prenom . ' ' . $prof->nom ?></h1>
	<div id="body">
		<p>

						<h3>
							<?php echo anchor('prof/voir/' . $prof->prof_id, $prof->prenom, array('title' => 'Voir la fiche de ' . $prof->prenom . ' ' . $prof->nom, 'hreflang' => 'fr')); ?>
						</h3>
						<div class="image">							
							<?php echo anchor('prof/voir/' . $prof->prof_id, '<img src="'. site_url() . THUMBS_DIR . $prof->photo. '" />', array('title' => 'Voir la fiche de ' . $prof->prenom . ' ' . $prof->nom, 'hreflang' => 'fr')); ?>
						</div>
						<p class="caractere">
							<?php echo $prof->caractere; ?>
						</p>
						<p class="specialite">
							<?php echo anchor('prof/lister/spec/' . $prof->spec_id, $prof->specialite, array('title' => 'Voir les profs spécialisés ' .$prof->specialite, 'hreflang' => 'fr')); ?>
						</p>
						<p>
							<?php if( !isset($deja_adoptes[$prof->prof_id] ) ) { ?>
								<?php echo anchor('prof/adopte/' . $prof->prof_id, 'Adopte ce prof !', array('title' => 'Adopter ce prof !', 'hreflang' => 'fr')); ?>
							<?php } else { ?>
								<?php echo anchor('prof/liberer/' . $prof->prof_id, 'Liberer ce prof !', array('title' => 'Liberer ce prof !', 'hreflang' => 'fr')); ?>
							<?php } ?>
						</p>

		</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>