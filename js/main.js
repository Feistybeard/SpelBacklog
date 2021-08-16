//döljer/visar visa divar som användes under tiden information hämtas från API
$('div').css("visibility", "hidden");
$('.details-button').css("visibility", "hidden");
$('#navbar').css("visibility", "visible");
$('.ajax-loader').css("visibility", "visible");

let apiKey = 'xxxxxx' //grab a key from the video game website www.giantbomb.com

//när dokumented är färdig laddat
$(document).ready(function () {
  //hämtas spelets namn med en funktion som hämtar texten från id title i html
  //och retunerar det
  let $title = getGameTitle();
  //använder title sedan för att först göra en sökning på spel titeln och få
  //den specifika id till spelet från API:et som sedan användes för att hämta mer
  //information om spelt
  getGameGUID($title);
});

//hämtar och retunerar texten i id title i html(spel titeln)
function getGameTitle() {
  let $str = $('#title').text();
  return $str;
}

//gör ett ajax anrop som söker API:et med speltiteln och hämtar endas id:et som sedan användes i getGameData
//för att hämta mer info som inte finns i vanlig sökning
function getGameGUID(query) {
  $.ajax({
    url: 'https://www.giantbomb.com/api/search/',
    type: 'GET',
    data: {
      api_key: apiKey,
      query: query,
      resources: 'game',
      format: 'jsonp',
      field_list: 'guid',
      json_callback: 'getGameData'
    },
    dataType: 'jsonp'
  });
}

//hämtar mer info om det specifika spelet genom id:et som man hämtat tidigare och vissar diven som inehåller
//en laddnings animation medans informationen hämtas och sedan döljs denna div när allt är hämtat, annars
//vissas ett felmeddelande
function getGameData(data) {
  if (data.results.length) {
    $.ajax({
      beforeSend: function () {
        $('.ajax-loader').css("visibility", "visible");
      },
      url: 'https://www.giantbomb.com/api/game/' + data.results[0].guid,
      type: 'GET',
      data: {
        api_key: apiKey,
        resources: 'game',
        format: 'jsonp',
        json_callback: 'showGameData'
      },
      dataType: 'jsonp',
      complete: function () {
        $('div').css("visibility", "visible");
        $('.details-button').css("visibility", "visible");
        $('.ajax-loader').css("visibility", "hidden");
      }
    });
  } else {
    alert('Could Not Find Game On GiantBombAPI!');
    $('div').css("visibility", "visible");
    $('.details-button').css("visibility", "visible");
    $('.ajax-loader').css("visibility", "hidden");
  }
}

//skriver ut den information jag vill ha från spelet som hämtades
function showGameData(data) {
  let gamedata = data.results;

  //skriver ut alla platformar spelet finns till med (,) i mellan så länge det inte är sista platformen
  for (let i = 0; i < gamedata.platforms.length; i++) {
    if (i === gamedata.platforms.length - 1) {
      $('#platforms').append('<li>' + gamedata.platforms[i].name + '&nbsp;</li>');
    } else {
      $('#platforms').append('<li>' + gamedata.platforms[i].name + ',&nbsp;</li>');
    }
  }

  //skriver ut alla tillverkare av spelet som finns med (,) i mellan så länge det inte är sista platformen
  for (let index = 0; index < gamedata.developers.length; index++) {
    if (index === gamedata.developers.length - 1) {
      $('#developers').append('<li>' + gamedata.developers[index].name + '&nbsp;</li>');
    } else {
      $('#developers').append('<li>' + gamedata.developers[index].name + ',&nbsp;</li>');
    }
  }

  //skriver ut release datum av spelet om det är släppt annars slås dagen/månaden/året som spelet ihop och skrivs ut
  if (gamedata.expected_release_day != null) {
    $('#releasedate').append(gamedata.expected_release_day + "/" + gamedata.expected_release_month + "/" + gamedata.expected_release_year);
  } else {
    let releaseDate = new Date(gamedata.original_release_date).toLocaleDateString();
    $('#releasedate').append(releaseDate);
  }

  //skriver ut gengre av spelet om det finns
  if (gamedata.genres != null) {
    for (let i = 0; i < gamedata.genres.length; i++) {
      if (i === gamedata.genres.length - 1) {
        $('#genres').append('<li>' + gamedata.genres[i].name + '&nbsp;</li>');
      } else {
        $('#genres').append('<li>' + gamedata.genres[i].name + ',&nbsp;</li>');
      }
    }
  } else {
    $('#genres').append('<li>N/A</li>');
  }

  //skriver ut deck information av spelet
  $('#deck').append(gamedata.deck);

  //ibland kan det finnas lokala länkar i deck informationen som hämtas, dessa tas bort här och ignorerar min sidas länkar
  $("a").each(function () {
    if ($(this).hasClass('ignore')) {
      //ignorera
    } else {
      $(this).removeAttr('href');
    }
  });
}
