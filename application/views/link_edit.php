<div id="bienvenue">
	Bienvenue <?php echo $this->session->userdata('pseudo'); ?> ! <a href="<?php echo site_url(); ?>member/deconnexion">Se déconnecter</a>
</div>

<div id="member">
	<h2>Modifier un lien</h2>

	<?php if( @$error ) {
			echo $error;
		} ?>


	<?php
		echo form_open('link/edit/' . $this->uri->segment(3), array('method' => 'post'));
		echo form_label('Adresse', 'lien');
		$adresseInput = array(
			'name' => 'lien',
			'id' => 'lien',
			'value' => $lien['lien'],
			'size' => '45'
		);
		
		echo form_input($adresseInput);
		
		
		echo form_label('Titre', 'titre');
		$titreInput = array(
			'name' => 'titre',
			'id' => 'titre',
			'value' => $lien['titre'],
			'size' => '45'
		);
		
		echo form_input($titreInput);
		echo '<br />';
		echo form_label('Description', 'description');
		$descInput = array(
			'name' => 'description',
			'id' => 'description',
			'value' => $lien['description'],
			'rows' => 6,
			'cols' => 45
		);
		
		echo form_textarea($descInput);	
		
		$imageInput = array(
			'image' => $lien['image']
		);
		
		echo form_hidden($imageInput);
		?>
		
		<img src="<?php echo $lien['image']; ?>" alt="Image <?php echo $lien['titre']; ?>" />
		
		
		<input type="submit" id="modifier" name="modifier" value="Modifier">
		<?php		
		//echo form_submit( array("id" => "ok", "name" => "ajouter", "value"=>"ajouter"));
		echo form_close();
	?>

</div>
