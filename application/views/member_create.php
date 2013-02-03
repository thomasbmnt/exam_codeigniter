<div id="member">
	<h2>Création d'un compte</h2>
	
	<?php
		if( @$error ) {
			echo $error;
		}
		echo form_open('member/createAccount', array('method' => 'post'));
		
		echo form_label('Nom', 'nom');
		$nameInput = array(
			'name' => 'nom',
			'id' => 'nom'
		);
		
		echo form_input($nameInput);
		
		echo form_label('Email', 'email');
		$emailInput = array(
			'name' => 'email',
			'id' => 'email'
		);
		
		echo form_input($emailInput);
		
		echo form_label('Mot de passe', 'mdp');
		$passwordInput = array(
			'name' => 'mdp',
			'id' => 'mdp'
		);
		
		echo form_password($passwordInput);
		
		echo form_label('Confirmation', 'mdp_confirmation');
		$passwordInputConfirm = array(
			'name' => 'mdp_confirmation',
			'id' => 'mdp_confirmation'
		);
		
		echo form_password($passwordInputConfirm);
		
		echo '<br>';
		
		echo form_submit('create', 'Créer mon compte');
		echo form_close();
	?>
	
	
</div>