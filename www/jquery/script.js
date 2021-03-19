$(document).ready(function()
{

/*GESTION DU MENU ET DE LA RECHERCHE (APPARITION)*/
	/*MENU*/
	$(".menu_ic").on('click',function() {
		slide_display('nav');
	});

	/*RECHERCHE*/
	$(".search_ic").on('click',function() {
  		slide_display('#src_pg');
	});

	$("#search_ic2").on('click',function() {
		$('html, body').animate({
			scrollTop: $("#src_pg").offset().top
		}, 1000);
	});



/*FILTRES GLOBAUX DE RECHERCHE*/
	$('.custom-control-input').on('click',function(){
		if( $('.custom-control-input:checked').val()=='opt4'){
			$('.extra-s').slideDown();
		}
		else{
			$('.extra-s').slideUp();
		}
	});

	/*RESET*/
	$('#reset_btn').on('click', function(){
		if($('.extra-s').css('display')=='block'){
			$('.extra-s').slideUp();
		}
	});



/*RECHERCHE AUTOCOMPLETION DE LA VILLE*/
	$("#cp_selec").keyup(function()
	{
		var cp= $('#cp_selec').val();
		if(cp.length==5){
			call_api_ville(cp,'c');
		}

	});

	$("#ville_selec").keyup(function()
	{
		var ville= $('#ville_selec').val();
		if(ville.length>=2){
			call_api_ville(ville, 'v')
		}
	});

})




//Fonctions principales appelées par les events

function slide_display(identifiant) {
	var h = $(document).height();
	if($(identifiant).height()==0){
		
		$(identifiant).css({'display': 'flex','height' : h});

	}
	else {
		$(identifiant).height(0).hide();
	}
};



function call_api_ville(donnee, code) {

	var xhr = new XMLHttpRequest(); // Initialisation de la requête asynchrone
	
	if(code=='c'){
		xhr.open("GET", "https://geo.api.gouv.fr/communes?codePostal="+donnee+"&fields=nom&format=json&geometry=centre");
	}
	else if(code=='v') {
		xhr.open("GET", "https://geo.api.gouv.fr/communes?nom="+donnee+"&fields=nom,codesPostaux&format=json&geometry=centre");
	}
	$('#data-ville-sel option').remove();
	$('#data-cp-sel option').remove();

	xhr.onload = function()
	{
		if( xhr.status == 200 ) // Vérification du succès de la réponse à la requête 
		{
			var response = JSON.parse(xhr.response);

			for(let i=0;i<15;i++) //Boucle sur tous les résultats
			{
				retour = response[i];
				if(code=='c'){
					$('#data-ville-sel').append(`<option>`+retour.nom+`</option>`);
				}
				else if(code=='v'){
					if(retour.codesPostaux.length>1){
						for(code in retour.codesPostaux){
							$('#data-cp-sel').append(`<option>`+retour.codesPostaux[code]+`</option>`);
						}
					}
					else{
						$('#data-cp-sel').append(`<option>`+retour.codesPostaux+`</option>`);
					}
					$('#data-ville-sel').append(`<option>`+retour.nom+`</option>`);
				}
			}

		}
	};
	xhr.send();

}