/*** Cette fonction initialise la carte ***/
var map;
function initialize() {
  var mapOptions = {
    zoom: 13,
    center: new google.maps.LatLng(46.3471054, -72.57770060000001)
  };
  map = new google.maps.Map(document.getElementById('map_canvas'),
      mapOptions);
}

/*** Cette fonction charge la carte dans la page ***/
function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
      'callback=initialize';
  document.body.appendChild(script);
}

window.onload = loadScript;

/*** Cette fonction verifie que l'email est de la forme xxxx@yyyy.zzz ***/
function validateEmail(email)
{ 
  var re = /\S+@\S+\.\S+/; 
  return re.test(email) && email != ""; 
}

/*** Cette fonction verifie qu'un champ n'est pas vide ***/
function verifChamps(item, message, placeholder){
  if($(item).val() == "" || $(item).val() == placeholder)
  {
    alert(message);
    $(item).focus();
    return false;
  }
  return true;
}

/*** Cette fonction fait appelle a la precedente pour verifier les champs que l'on souhaite ***/
function validate()
{
  if (!verifChamps("input[name='nom']", "Vous n'avez pas donné votre nom", "Saisissez un nom")) {  // On verifie que le nom est rentre
    return false;
  }

  if (!verifChamps("input[name='prixPost']", "Vous n'avez pas donné le prix", "Saisissez un prix")) { // On verifie qu'un prix est rentre
    return false;
  }

  if (!verifChamps("textarea[name='description']", "Vous n'avez pas donné la description", "")) { // On verifie que la description est rentree
    return false;
  } 

  /* Verification que la description fait au moins 5 caracteres */
  var long1 = $("textarea[name='description']").val().length
  if(long1 < 5)
  {
    alert("Votre description est trop courte car il faut 5 caractères minimum. Elle contient "+ long1 + " caractères.");
    $("textarea[name='description']").focus();
    return false;
  }

  if (!validateEmail($("input[name='email']").val())) // Affiche un message d'erreur si l'email n'est pas au bon format
  {
    alert("Votre email n'est pas bon.");
    $("input[name='email']").focus()
    return false;
  }

  return true;
}

/*** Cette fonction permet de cacher/afficher un panel ***/
function hideShowPanel(panel) {
  if ($(panel).css("visibility") == "hidden") {
    $('div[class^="panel"]').css("visibility", "hidden");
    $(panel).css("visibility", "visible");
  }
  else {
    $(panel).css("visibility", "hidden");
  }
}

/*** Cette fonction permet de placer un "placeholder" dans les cases du formulaire ***/
function placeholder(item, pholder){
  $(item).val(pholder);
  $(item).css("color","gray")
  $(item).focus(function() {
    if( $(this).val() == pholder ) {
      $(this).val("");
      $(this).css("color","black");
    }
  }).blur(function() {
    if ($(this).val() == "") {
      $(this).css("color","gray");
      $(this).val(pholder);
    }
  }).blur();
}

$(".header").corner("20px bottom");
$(".content").corner("20px");
$("#map_canvas").corner("20px");
$('div[class^="panel"]').corner("5px");
$(".buttonSwitch").corner("5px");
$( 'div[class^="panel"]' ).draggable();

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
  placeholder("input[name='mot']", "Saisissez un mot clef") // Affiche un placeholder dans le champ mot clef
  placeholder("input[name='email']", "Saisissez un email")  // Affiche un placeholder dans le champ email
  placeholder("input[name='prixPost']", "Saisissez un prix")// Affiche un placeholder dans le champ prix
  placeholder("input[name='nom']", "Saisissez un nom")		// Affiche un placeholder dans le champ nom

  $( ".buttonSwitch" ).click(function() {
    console.log("yo");
    center = map.getCenter()
    setTimeout(function() {
    google.maps.event.trigger(map,'resize');map.setCenter(center); // adapte la carte au conteneur
  }, 500);
  });
});