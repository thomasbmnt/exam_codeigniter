$(function(){
	//$('a[rel*=external]').attr('target', '_new');
	
	var $images = $(".site_image figure"); 
	
	$images.first().children('div').children('input').attr("checked", "checked");
	
	$images.not(':first').hide();
	$(".selectionner").hide();

	
	$("#next").on("click", switchNext);
	$("#previous").on("click", switchPrevious);


	function switchPrevious(e){
		e.preventDefault();
		var $nextImage = $images.filter(':visible').prev("figure");
		
		if( $nextImage.size() == 0 )
			$nextImage = $images.last();
		
		$images.filter(':visible').fadeOut('fast', function(){
			$nextImage.fadeIn('fast');
		});
		
		$("input[checked=checked]").removeAttr("checked");
		$nextImage.children('div').children('input').attr("checked", "checked");
		
	}
	
	function switchNext(e)
	{
		e.preventDefault();
		var $nextImage = $images.filter(':visible').next("figure");
		
		if( $nextImage.size() == 0 )
			$nextImage = $images.first();
		
		$images.filter(':visible').fadeOut('fast', function(){
			$nextImage.fadeIn('fast');
		});
		
		$("input[checked=checked]").removeAttr("checked");
		$nextImage.children('div').children('input').attr("checked", "checked");
	}
	
});


$(".delete").on("click", function(event){
	var lien = $(this).attr("href");
	var lienId = $(this).attr("rel");
	event.preventDefault();
	$.ajax({
		url: lien,
		success : function(){ 
				$('#lien_'+lienId).fadeOut('fast');
		}
	});
	
	return false;
});



$("input#submitForm").on("click", function(event){
	event.preventDefault();
	var add = "<b>Le lien a bien été ajouté</b>";
	//alert($("input#submitForm").val());

var form_data = {
	titre : $("input[name=titre]").val(),
	description : $("textarea[name=description]").val(),
	image : $("input[checked=checked]").val(),
	lien : $("input[name=lien]").val()
	};
	
	$.ajax({
			type: "POST",
			url: $(this).parent().attr("action"),
			data: form_data,
			success : function(){ 
					$('	<div"><h2>' +  $("input[name=titre]").val() + '</h2><p><p>' + $("textarea[name=description]").val() +'</p></p><p><img src="' + $("input[checked=checked]").val() + '" /></p><hr /></div>').appendTo("#added");
					$("#linkAdded").fadeOut('slow');
			}
		});
	
	return false;


});



/*
$("#connexionForm").submit( function() {	// à la soumission du formulaire						 
	$.ajax({ // fonction permettant de faire de l'ajax
	   type: "POST", // methode de transmission des données au fichier php
	   url: "login.php", // url du fichier php
	   data: "login="+$("#login").val()+"&pass="+$("#pass").val(), // données à transmettre
	   success: function(msg){ // si l'appel a bien fonctionné
			if(msg==1) // si la connexion en php a fonctionnée
			{
				$("div#connexion").html("<span id=\"confirmMsg\">Vous &ecirc;tes maintenant connect&eacute;.</span>");
				// on désactive l'affichage du formulaire et on affiche un message de bienvenue à la place
			}
			else // si la connexion en php n'a pas fonctionnée
			{
				$("span#erreur").html("<img src=\"bomb.png\" style=\"float:left;\" />&nbsp;Erreur lors de la connexion, veuillez v&eacute;rifier votre login et votre mot de passe.");
				// on affiche un message d'erreur dans le span prévu à cet effet
			}
	   }
	});
	return false; // permet de rester sur la même page à la soumission du formulaire
});
*/