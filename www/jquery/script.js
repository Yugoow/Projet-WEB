$(document).ready(function()
{

	if ('serviceWorker' in navigator) {
		window.addEventListener('load', () => {
			navigator.serviceWorker
			.register('../../sw.js')
			.then(registration => {
				console.log(
					`Service Worker enregistré ! Ressource: ${registration.scope}`
				);
			})
			.catch(err => {
				console.log(
				`Echec de l'enregistrement du Service Worker: ${err}`
				);
			});
		});
	}
/*OFFRE GESTION AFFICHAGE*/
	if ($('#titre_offre').text() == "")
	{
		$('#offre_stage').css({'display': 'none'});
	} else
	{
		$('#offre_stage').css({'display': 'block'});
	}	

	$('#input_mdp').prop('required', true);
/*GESTION DU MENU ET DE LA RECHERCHE (APPARITION)*/
	/*MENU*/
	$(".menu_ic").on('click',function() {
		slide_display('nav');
	});

	/*RECHERCHE*/
	$(".search_ic").on('click',function() {
  		slide_display('#src_pg');
	});

	/*WISHLIST*/
	$("#search_ic3").on('click',function() {
		$('#search_bar2').css({'border': '1px solid rgb(153, 153, 153,.6)' , 'border-radius': '3.5px' , 'transition' : '330ms' , 'width' : '16rem'});
		$('#search_ic3').css({'display': 'none'});
	});


/*AJOUT A LA WISH LIST DEPUIS LE MENU*/
	$('.not_wish').click(function() {
	 	var id = $(this).prop('id').split('_')[1];
		$.ajax({
			type: "POST",
			url: "Req_ajax.php",
			data: { id_wish: id }
			}).done(function( response ) {
				$('.toast').css('opacity','1');
				$('#body_info').html(response);
		});
	});

/*SUPPRESSION DE LA WLIST*/
	$('.in_wish').click(function() {
		var id = $(this).prop('id').split('_')[1];
		$.ajax({
			type: "POST",
			url: "Req_ajax.php",
			data: { id_del: id }
			}).done(function( response ) {
				$('#wish_alert').html(response);
		});
	});


/*FILTRES GLOBAUX DE RECHERCHE*/
	$('#search_f .custom-control-input').on('click',function(){
		if( $('#search_f .custom-control-input:checked').val()=='opt4'){
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

/*GESTION GLOBALES*/


	/*AFFICHAGE ID*/
	$('.custom-radio input').on('click', function(){
		var parent = $('#'+$(this).attr('id')).attr('id').split('_')[0];
		if($(this).val()=="creation"){
			$('#input_email').prop('readonly', false);
			$('#input-bloc-'+parent+' .form_s').hide();
			$('#input-bloc-'+parent+' .form_nos').show();
		}
		else if($(this).val()=="suppression"){
			$('#input-bloc-'+parent+' .form_s').show();;
			$('#input-bloc-'+parent+' .form_nos').hide();
		}
		else if($(this).val()=="modification"){
			$('#input_email').prop('readonly', true);
			$('#input-bloc-'+parent+' .form_s').show();
			$('#input-bloc-'+parent+' .form_nos').show();
		}
		else if($(this).val()=="autre"){
			$('#input-bloc-'+parent+' .form_s').hide();
		}
	});

	/*GENERATION MOT DE PASSE*/
   
    $('#hide_mdp').on('click', function(){
    	$('#input_mdp').attr('type','password');
    	$(this).toggle()
    	$('#show_mdp').show();

    });

	$('#show_mdp').on('click', function(){
    	$('#input_mdp').attr('type','text');
    	$(this).toggle()
    	$('#hide_mdp').show();
    });

	$("#mdp_rng").on("change", function(){
		var val=$(this).val();
		$('#input_size').val(val); 
	})


	$("#input_size").on("change", function(){
		var val=$(this).val();
		$('#mdp_rng').val(val); 
	})


	/*Message suppression modification etc*/
	$('#valid_btn').on('click', function(){
		var nom =$('#input_last').val();
		var id =$('#input_id').val();
		var prenom = $('#input_firstn').val();
		var act = $('.action_user:checked').val();
		if(act=="suppression"){
			$('.form_s').prop('required', true);
			$('.form_nos').prop('required', false);
		}
		else if (act=="creation"){
			$('.form_s').prop('required', false);
			$('.form_nos').prop('required', true);		
		}
		else if(act=="modification"){
			$('.form_s').prop('required', true);
			$('.form_nos').prop('required', true);
			$('#input_mdp').prop('required', false);
		}

		if((nom && prenom) || id){
			$('#p_modal').text("Voulez vous vraiment effectuer une "+ act+" d'utilisateur : \n"+nom+' '+prenom);
			$('#validation_Label').text(act).css('text-transform','capitalize');

		}
		else{
			$('#p_modal').text("Veuillez compléter toutes les informations requises");
			$('#validation_Label').text(act).css('text-transform','capitalize');
		}
	})

	$('#valid_btn1').on('click', function(){
		var offre = $('#input_entreprise').val();
		var act = $('.action_offre:checked').val();

		if(offre){
			$('#p_modal1').text("Voulez vous vraiment effectuer une "+ act+" d'offre : \n"+offre);
			$('#validation_Label1').text(act).css('text-transform','capitalize');
		}
		else{
			$('#p_modal1').text("Veuillez compléter toutes les informations requises");
			$('#validation_Label1').text(act).css('text-transform','capitalize');
		}
	})

	$('#valid_btn2').on('click', function(){
		var entreprise =$('#input_nom_e').val();
		var act = $('.action_entreprise:checked').val();

		if(entreprise){
			$('#p_modal2').text("Voulez vous vraiment effectuer une "+ act+" d'entreprise : \n"+entreprise);
			$('#validation_Label2').text(act).css('text-transform','capitalize');
		}
		else{
			$('#p_modal2').text("Veuillez compléter toutes les informations requises");
			$('#validation_Label2').text(act).css('text-transform','capitalize');
		}
	})



/*GESTION MODIFICATION USER*/
	$('#input_id').on('keyup', function() {
		var id = $(this).val();
		$.ajax({
			type: "POST",
			dataType:"json",
			url: "Req_ajax.php",
			data: { id_modif: id }
			}).done(function( response ) {
				$("#input_last").val(""+response.Nom+"");
				$("#input_firstn").val(""+response.Prenom+"");
				$("#promotion_selec").val(response.Promotion);
				$("#input_centre").val(""+response.Centre+"");
				$("#role_selec").val(""+response.id_Roles+"");
				$("#input_email").val(""+response.Identifiant+"");
		});
	});


});




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

/*Ville dans recherche d'entreprise*/
function call_api_act(donnee) {

	var xhr = new XMLHttpRequest(); // Initialisation de la requête asynchrone

	xhr.open("GET", "https://geo.api.gouv.fr/communes?nom="+donnee+"&fields=nom,codesPostaux&format=json&geometry=centre");

	$('#data-act-sel option').remove();

	xhr.onload = function()
	{
		if( xhr.status == 200 ) // Vérification du succès de la réponse à la requête 
		{
			var response = JSON.parse(xhr.response);

			for(let i=0;i<15;i++) //Boucle sur tous les résultats
			{
				retour = response[i];
				$('#data-act-sel').append(`<option>`+retour.nom+`</option>`);
			}
		}
	};
	xhr.send();

}

/*GENERATION DU MDP*/
function generate(l) {
	$('#input_size').val(l);
	if (typeof l==='undefined'){var l=8;}
	/* c : chaîne de caractères alphanumérique */
	var c='abcdefghijknopqrstuvwxyzACDEFGHJKLMNPQRSTUVWXYZ12345679',
	n=c.length,
	/* p : chaîne de caractères spéciaux */
	p='!@#$+-*&_/"[](){}',
	o=p.length,
	r='',
	n=c.length,
	/* s : determine la position du caractère spécial dans le mdp */
	s=Math.floor(Math.random() * (p.length-1));
	s2=Math.floor(Math.random() * (p.length-1));
	s3=Math.floor(Math.random() * (p.length-1));
	for(var i=0; i<l; ++i){
		if(s == i || s2== i || s3==i){
			/* on insère à la position donnée un caractère spécial aléatoire */
			r += p.charAt(Math.floor(Math.random() * o));
		}else{
			/* on insère un caractère alphanumérique aléatoire */
			r += c.charAt(Math.floor(Math.random() * n));
		}
	}
	return r;
}

//RECHERCHE AUTOCOMPLETION DU SECTEUR D'ACTIVITE

$("#act_selec").keyup(function()
	{
		var act= $('#act_selec').val();
		if(act.length>=2){
			call_api_act(act)
		}
	});



if(window.innerWidth>768){
	$('#search_f .custom-control-input').on('click',function(){
		if( $('#search_f .custom-control-input:checked').val()=='opt4'){
			$('#duree_style').addClass('style_duree');
		}
		else{
			$('#duree_style').removeClass('style_duree');
		}
	});
	$('.custom-radio').addClass('custom-control-inline');
} else {
	$('.custom-radio').removeClass('custom-control-inline');
}

