<div id="bienvenue">
	Bienvenue <?php echo $this->session->userdata('pseudo'); ?> ! <a href="<?php echo site_url(); ?>member/deconnexion">Se déconnecter</a>
</div>

<div id="member">
	<h2>Ajout d'un lien</h2>
	
	<?php
		echo form_open('link/load', array('method' => 'post'));
		
		echo form_label('Adresse', 'adresse');
		$emailInput = array(
			'name' => 'adresse',
			'id' => 'adresse'
		);
		
		echo form_input($emailInput);

		echo '<br>';
		
		echo form_submit('check', 'vérifier');
		echo form_close();
		if( isset( $error) ) 
			echo $error;
	?>
	
	<div id="linkAdded">
	<?php if( isset( $_POST["check"] ) && !isset( $error ) ) : ?>
		<?php
			echo form_open('link/ajouter', array('method' => 'post'));
			echo form_label('Adresse', 'lien');
			$adresseInput = array(
				'name' => 'lien',
				'id' => 'lien',
				'value' => $adresse,
				'size' => '45'
			);
			
			echo form_input($adresseInput);
			
			
			echo form_label('Titre', 'titre');
			$titreInput = array(
				'name' => 'titre',
				'id' => 'titre',
				'value' => (!empty($titreURL[1])) ? $titreURL[1] : $this->input->post('adresse'),
				'size' => '45'
			);
			
			echo form_input($titreInput);
			echo '<br />';
			echo form_label('Description', 'description');
			$descInput = array(
				'name' => 'description',
				'id' => 'description',
				'value' => (!empty($descriptionURL[1])) ? $descriptionURL[1] : "",
				'rows' => 6,
				'cols' => 45
			);
			
			echo form_textarea($descInput);	
			?>
			<?php if( count($imagesURL[1]) != 0 ) { ?>
			<div class="site_image">
				<button id="previous">Précédent</button>
				<button id="next">Suivant</button>
				<?php foreach($imagesURL[1] as $cle => $value ) : ?>
					<figure>
						<?php if( $value[0] == 'h' ) { ?>
							<img src="<?php echo $value ; ?>" rel="<?php echo $cle; ?>" />
						<?php } else { ?>
							<img src="<?php echo $adresse; ?><?php echo $value ; ?>" rel="<?php echo $cle; ?>" />
						<?php } ?>
						<br />Image <?php echo $cle+1; ?>/<?php echo count($imagesURL[1]); ?>
						<div class="selectionner">
							<?php
								$radioInput = array(
									'name' => 'image',
									'id'	=> 'image'.$cle,
									'value' => $value
								);
								
								echo form_radio($radioInput);
							?>
							Sélectionner
						</div>
					</figure>

				<?php endforeach; ?>
			</div>
			<?php } ?>
			<input type="submit" id="submitForm" name="ajouter" value="ajouter">
			<?php		
			//echo form_submit( array("id" => "ok", "name" => "ajouter", "value"=>"ajouter"));
			echo form_close();
		?>
	<?php endif; ?>
	</div>

	<div id="added">
	
	</div>
	<section>
	<?php foreach($liens as $lien) : ?>
	<article id="lien_<?php echo $lien['idLink']; ?>">
		<span class="error_delete<?php echo $lien['idLink']; ?>"></span>
		<a href="<?php echo $lien['lien']; ?>"><h2><?php echo $lien['titre']; ?></h2></a>
		<p><p><?php echo $lien['description']; ?></p></p>
		<p><img src="<?php echo $lien['image']; ?>" /></p>
		<a rel="<?php echo $lien['idLink']; ?>" href="link/delete/<?php echo $lien['idLink']; ?>" class="delete">Supprimer</a> - 
		<a rel="<?php echo $lien['idLink']; ?>" href="link/edit/<?php echo $lien['idLink']; ?>" class="edit">Modifier</a> - 
		<a name="fb_share" type="button_count" share_url="<?php echo $lien['lien']; ?>"><?php echo $lien['titre']; ?></a>
		<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share"   type="text/javascript"></script>
		<hr />
	</article>
		
	<?php endforeach; ?>
	</section>
</div>

