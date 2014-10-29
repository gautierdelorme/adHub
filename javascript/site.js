var map;
function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(43.604652, 1.4442090000000007)
  };
  map = new google.maps.Map(document.getElementById('map_canvas'),
      mapOptions);
}

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
      'callback=initialize';
  document.body.appendChild(script);
}

window.onload = loadScript;

// Validation de l'Email dans le formulaire Post
function validateEmail(email)
{ 
  var re = /\S+@\S+\.\S+/; 
  return re.test(email) && email != ""; 
}

// Validation des champs du formulaire
function verifChamps(item, message, placeholder){
  if($(item).val() == "" || $(item).val() == placeholder)
  {
    alert(message);
    $(item).focus();
    return false;
  }
  return true;
}

function validate()
{
  if (!verifChamps("input[name='nom']", "Vous n'avez pas donné votre nom", "Saisissez un nom")) {
    return false;
  }

  if (!verifChamps("input[name='prixPost']", "Vous n'avez pas donné le prix", "Saisissez un prix")) {
    return false;
  }

  if (!verifChamps("textarea[name='description']", "Vous n'avez pas donné la description", "")) {
    return false;
  }

  /* Vérification que la description fait au moins 5 caractères */
  var long1 = $("textarea[name='description']").val().length
  if(long1 < 5)
  {
    alert("Votre description est trop courte car il faut 5 caractères minimum. Elle contient "+ long1 + " caractères.");
    $("textarea[name='description']").focus();
    return false;
  }

  if (!validateEmail($("input[name='email']").val()))
  {
    alert("Votre email n'est pas bon.");
    $("input[name='email']").focus()
    return false;
  }

  return true;
}

function hideShowPanel(panel) {
  if ($(panel).css("visibility") == "hidden") {
    $('div[class^="panel"]').css("visibility", "hidden");
    $(panel).css("visibility", "visible");
  }
  else {
    $(panel).css("visibility", "hidden");
  }
}

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
  placeholder("input[name='mot']", "Saisissez un mot clef")
  placeholder("input[name='email']", "Saisissez un email")
  placeholder("input[name='prixPost']", "Saisissez un prix")
  placeholder("input[name='nom']", "Saisissez un nom")

  $( ".buttonSwitch" ).click(function() {
    console.log("yo");
    center = map.getCenter()
    setTimeout(function() {
    google.maps.event.trigger(map,'resize');map.setCenter(center);
  }, 500);
  });
});