<div id="member">
	<h2>Connexion à votre compte</h2>
	
	<?php
		echo form_open('member/login', array('method' => 'post'));
		
		echo form_label('adresse email', 'email');
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
		
		echo '<br>';
		
		echo form_submit('check', 'vérifier');
		echo form_close();
	?>
		<a href="member/create">Créer un compte</a> 
	
	
</div>