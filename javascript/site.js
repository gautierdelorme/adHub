/*** Cette fonction initialise la carte ***/
var map;
var markers = [];
var dataList;
function initialize() {
  var mapOptions = {
    zoom: 13,
    center: new google.maps.LatLng(46.3471054, -72.57770060000001)
  };
  map = new google.maps.Map(document.getElementById('map_canvas'),
    mapOptions);
}

function addMarker(owner, data) {
  var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">'+data['title_'+getCookie('language')]+'</h1>'+
      '<div id="bodyContent">'+
      '<p>Description : '+data['description_'+getCookie('language')]+'</p>'+
      '<p>Prix : $'+data['price']+'</p>'+
      '<p>Contact : '+owner+'</p>'+
      '</div>'+
      '</div>';
  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(data['latitude'],data['longitude']),
    map: map
  });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
  markers.push(marker);
}

// Sets the map on all markers in the array.
function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setAllMap(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setAllMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
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
function verifChamps(item, message, placeholder, message2, placeholder2){
  if (getCookie('language') == "fr") {
    if($(item).val() == "" || $(item).val() == placeholder)
    {
      alert(message);
      $(item).focus();
      return false;
    }
    return true;
  } else {
    if($(item).val() == "" || $(item).val() == placeholder2)
    {
      alert(message2);
      $(item).focus();
      return false;
    }
    return true;
  }
}

/*** Cette fonction fait appelle a la precedente pour verifier les champs que l'on souhaite ***/
function validate()
{
  if (!verifChamps("input[name='nomEnglish']", "Vous n'avez pas entré un nom anglais", "Saisissez le nom anglais", "Enter an english name", "Enter an english name")) {  // On verifie que le nom est rentre
    return false;
  }

  if (!verifChamps("input[name='nomFrench']", "Vous n'avez pas entré un nom français", "Saisissez le nom français", "Enter a french name", "Enter a french name")) {  // On verifie que le nom est rentre
    return false;
  }

  if (!verifChamps("input[name='prixPost']", "Vous n'avez pas donné le prix", "Saisissez un prix", "Enter a price", "Enter a price")) { // On verifie qu'un prix est rentre
    return false;
  }

  if (!verifChamps("input[name='latitude']", "Saisissez une latitude", "Saisissez une latitude", "Enter a latitude", "Enter a latitude")) { // On verifie qu'un prix est rentre
    return false;
  }

  if (!verifChamps("input[name='longitude']", "Saisissez une longitude", "Saisissez une longitude", "Enter a longitude", "Enter a longitude")) { // On verifie qu'un prix est rentre
    return false;
  }

  if (!verifChamps("textarea[name='descriptionEnglish']", "Vous n'avez pas donné la description anglaise", "", "Enter an english description", "")) { // On verifie que la description est rentree
    return false;
  }
  if (!verifChamps("textarea[name='descriptionFrench']", "Vous n'avez pas donné la description française", "", "Enter a french description", "")) { // On verifie que la description est rentree
    return false;
  }

  /* Verification que la description fait au moins 5 caracteres */
  var long1 = $("textarea[name='descriptionFrench']").val().length;
  var long2 = $("textarea[name='descriptionEnglish']").val().length
  if(long1 < 5)
  {
    if (getCookie('language') == "fr") {
      alert("Votre description française est trop courte car il faut 5 caractères minimum. Elle contient "+ long1 + " caractères.");
    } else {
      alert("Your french description is too short ("+ long1 + " characters). Min : 5.");
    }
    $("textarea[name='descriptionFrench']").focus();
    return false;
  }
  if(long2 < 5)
  {
    if (getCookie('language') == "fr") {
      alert("Votre description anglaise est trop courte car il faut 5 caractères minimum. Elle contient "+ long2 + " caractères.");
    } else {
      alert("Your english description is too short ("+ long2 + " characters). Min : 5.");
    }
    $("textarea[name='descriptionEnglish']").focus();
    return false;
  }

  /*if (!validateEmail($("input[name='email']").val())) // Affiche un message d'erreur si l'email n'est pas au bon format
  {
    alert("Votre email n'est pas bon.");
    $("input[name='email']").focus()
    return false;
  }*/

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

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
}

$(".header").corner("20px bottom");
$(".content").corner("20px");
$("#map_canvas").corner("20px");
$('div[class^="panel"]').corner("5px");
$(".buttonSwitch").corner("5px");
$('div[class^="panel"]').draggable();

$( document ).ready(function() {
  $( "#panelPost" ).submit(function( event ) {
    return validate();
  });
  $('.content').quickFlip();
  $(".buttonFind").click(function( event ) {
    hideShowPanel(".panelFind");
    event.preventDefault();
  });
  $(".buttonPost").click(function( event ) {
    hideShowPanel(".panelPost");
    event.preventDefault();
  });
  $('div[class^="buttonAccount"]').click(function( event ) {
    hideShowPanel(".panelAccount");
    event.preventDefault();
  });
  if (getCookie('language') == "fr") {
    placeholder("input[name='mot']", "Saisissez un mot clef") // Affiche un placeholder dans le champ mot clef
    placeholder("input[name='prixPost']", "Saisissez un prix")// Affiche un placeholder dans le champ prix
    placeholder("input[name='nomFrench']", "Saisissez le nom français")		// Affiche un placeholder dans le champ nom
    placeholder("input[name='nomEnglish']", "Saisissez le nom anglais")
    placeholder("input[name='latitude']", "Saisissez une latitude")
    placeholder("input[name='longitude']", "Saisissez une longitude")
  } else {
    placeholder("input[name='mot']", "Enter a keyword") // Affiche un placeholder dans le champ mot clef
    placeholder("input[name='prixPost']", "Enter a price")// Affiche un placeholder dans le champ prix
    placeholder("input[name='nomFrench']", "Enter a french name")   // Affiche un placeholder dans le champ nom
    placeholder("input[name='nomEnglish']", "Enter an english name")
    placeholder("input[name='latitude']", "Enter a latitude")
    placeholder("input[name='longitude']", "Enter a longitude")
  }

  $( ".buttonSwitch" ).click(function() {
    center = map.getCenter()
    setTimeout(function() {
      google.maps.event.trigger(map,'resize');map.setCenter(center); // adapte la carte au conteneur
    }, 500);
  });

  $( ".error" ).click(function() {
    $(this).hide();
  });

  $( ".success" ).click(function() {
    $(this).hide();
  });

  $.extend($.expr[':'], {
    'containsi': function(elem, i, match, array)
    {
      return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });

  $('#mot').autocomplete({
      serviceUrl: 'annonces.php',
      dataType: 'json',
      minChars: 2,
      appendTo: "",
      onSearchComplete: function (query, suggestions) {
        var stringIds = "";
        for (index = 0; index < suggestions.length; index++) {
          stringIds += suggestions[index].value+",";
        }
        stringIds = stringIds.substring(0, stringIds.length - 1);
        $.ajax({                                      
            url: 'annonces.php?load='+stringIds,
            dataType: 'json',
            success: function(data) {
              annonces = data.annonces;
              dataList = annonces;
              categories = data.categories;
              owners = data.owners;
              var futurHtml = "";
              for (index = 0; index < annonces.length; index++) {
                futurHtml +="<tr class=\"toDelete\">";
                futurHtml += "<td><img src=\"images/128x128/"+annonces[index]['category_option_name']+".png\" /></td>";
                futurHtml += "<td>"+categories[index]+"</td>";
                futurHtml += "<td>$"+annonces[index]['price']+"</td>";
                futurHtml += "<td>Toulouse</td>";
                futurHtml += "<td>"+annonces[index]['title_'+getCookie('language')]+"</td>";
                futurHtml += "<td>"+annonces[index]['description_'+getCookie('language')]+"</td>";
                futurHtml += "</tr>";
              }
              $('.toDelete').remove();
              $('.toHide').hide();
              $(".tabHeader").after(futurHtml);
              $(".frontView td:containsi("+query+")").each(function () {
                $(this).html($(this).html().replace(new RegExp(query, "ig"), "<span class='query'>"+query+"</span>"));
              });
              deleteMarkers();
              for (var i = 0; i < dataList.length; i++) {
                addMarker(owners[i],dataList[i]);
              }
            } 
          });
      },
      onSearchError: function (query, jqXHR, textStatus, errorThrown) {
        $('.toDelete').remove();
        deleteMarkers();
      }
    });
  $('#mot').on('input', function() {
    if($(this).val().length < 3 ) {
      $('.query').removeClass('query')
      $('.toDelete').remove();
      deleteMarkers();
      $('.toHide').show();
    }
  });
});