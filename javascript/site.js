function initialise() {
				var latlng = new google.maps.LatLng(46.347301, -72.577690);
				//objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
				//de définir des options d'affichage de notre carte
				var options = {
					center: latlng,
					zoom: 19,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				
				//constructeur de la carte qui prend en paramêtre le conteneur HTML
				//dans lequel la carte doit s'afficher et les options
				var map_canvas = new google.maps.Map(document.getElementById("map_canvas"), options);
			}


function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;callback=initialize';
  document.body.appendChild(script);
  console.log('load');
}

window.onload = loadScript;
$(".header").corner("20px bottom");
$(".content").corner("20px");
$('div[class^="panel"]').corner("5px");
$(".buttonSwitch").corner("5px");
$( 'div[class^="panel"]' ).draggable();

function hideShowPanel(panel) {
  if ($(panel).css("visibility") == "hidden") {
    $('div[class^="panel"]').css("visibility", "hidden");
    $(panel).css("visibility", "visible");
  }
  else {
    $(panel).css("visibility", "hidden");
  }
}

/*** Validation de l'Email dans le formulaire Post ***/
function validateEmail(email)
{ 
var re = /\S+@\S+\.\S+/; 
return re.test(email); 
}

/*** Validation du formulaire Post ***/
function validate()
{
/* Vérification que le nom n'est pas vide */
 if(document.forms['panelPost'].elements['nom'].value=="")
 { alert("Vous n'avez pas donné votre nom"); 
 document.forms['panelPost'].elements['nom'].focus();
 return false;
 }
 
 /* Vérification que le prix n'est pas vide */
 if(document.forms['panelPost'].elements['prixPost'].value=="")
 { alert("Vous n'avez pas donné le prix"); 
 document.forms['panelPost'].elements['prixPost'].focus();
 return false;
 }
 
 /* Vérification que la description n'est pas vide */
 if(document.forms['panelPost'].elements['description'].value=="")
 { alert("Vous n'avez pas donné la description"); 
 document.forms['panelPost'].elements['description'].focus();
 return false;
 }
 
 /* Vérification que la description fait au moins 5 caractères */
 var long1 = document.forms['panelPost'].elements['description'].value.length;
 if(long1 < 5){
 alert("Votre description est trop courte car il faut 5 caractères minimum. Elle contient "+ long1 + " caractères.");
 document.forms['panelPost'].elements['decription'].focus();
 return false;
 } 

}
$( document ).ready(function() {
  $('.content').quickFlip();
  $(".buttonFind").click(function( event ) {
    hideShowPanel(".panelFind");
    event.preventDefault();
  });
  $(".buttonPost").click(function( event ) {
    hideShowPanel(".panelPost");
    event.preventDefault();
  });
});