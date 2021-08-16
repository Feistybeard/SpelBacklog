<!--========================================
  HEADER/MENY
=========================================-->
<?php
//innehåller head och början av html samt menyn till sidan
include "menu.php";
//innehåller funktioner till sidan bland annat databashantering(CRUD).
//constanten DIR setts i menu.php och pekar på include mappen
include DIR . "func.php";

/*========================================
  HTTP GET
========================================*/
//kollar om id variabeln är satt genom http get och
//skickar då sql fråga till en funktion som retunerar
//svaret till $result variabeln
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM spel WHERE Id = $id";
  $result = getGame($sql);
  if (mysqli_num_rows($result) > 0) {
    //om reultat av sql frågan innehåller ett inlägg så sparas alla värden
    //från inlägget till olika variabler som sedan användes för att skriva
    //ut dem i html
    while ($row = mysqli_fetch_assoc($result)) {
      $title = $row['Title'];
      $release = $row['ReleaseYear'];
      $added = $row['DateAdded'];
      $imgurl = $row['ImageUrl'];
      //gör om datum till "rätt" format genom en funktion
      $date = revDate($added);
    }
  } else {
    //om inte resultat hittas i sql frågan skickas man till index
    //med en funktion
    goHome();
  }
} else {
  //om man inte skickat med ett id genom http get skickas man
  //till index med en funktion
  goHome();
}
?>

<!--========================================
  CONTENT
=========================================-->
<!-- visar en laddnings animation under tiden information hämtas från API -->
<div class="ajax-loader">
  <img src="images/ajax-loader.gif" alt="loading" />
</div>
<!-- skriver ut alla variabler som är satta, dem sätts i http get när inlägget hämtas -->
<div class="content">
  <div class="game-details">
    <div id="cover">
      <?php if (isset($imgurl)) echo "<img src=\"$imgurl\" alt=\"game box art\" />"; ?>
    </div>
    <div class="details">
      <h1 id="title">
        <?php if (isset($title)) echo $title; ?>
      </h1>
      <!-- id:n på html taggarna användes för att genom js/jqueary sätta in infromationen från API -->
      <ul id="platforms">
        <span class="thin-text">Platforms: </span>
      </ul>
      <ul id="developers">
        <span class="thin-text">Developers: </span>
      </ul>
      <ul id="genres">
        <span class="thin-text">Genre: </span>
      </ul>
      <p id="releasedate">
        <span class="thin-text">Release Date: </span>
      </p>
    </div>
    <h4 id="deck"></h4>
  </div>
</div>
<br />
<input class="details-button" type="button" value="| Go Back |" onclick="location.href='index.php'" />

<!--========================================
  FOOTER
=========================================-->
<?php
include "footer.php";
?>

<!--========================================
  SCRIPT
=========================================-->
<!-- läser in jquery som jag sedan använder i min js fil-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<!--  länkar in all min js/jqueary kod som bland annat inehåller ajax anrop till api-->
<script src="js/main.js"></script>