<!--========================================
  HEADER/MENY
=========================================-->
<?php
//innehåller head och början av html samt menyn till sidan
include "menu.php";
//innehåller funktioner till sidan bland annat databashantering(CRUD).
//constanten DIR setts i menu.php och pekar på include mappen
include DIR . "func.php";

// GET
//skapar en sql fråga som hämtar fram ett slumpmäsigt spel från databasen som
//skickas sedan till funktionen getGame som retunerar svaret i result variabeln
$sql = "SELECT * FROM spel ORDER BY RAND() LIMIT 1";
$result = getGame($sql);
if (mysqli_num_rows($result) > 0) {
  //om resultat av sql frågan innehåller ett inlägg så sparas alla värden
  //från inlägget till olika variabler som sedan användes för att skriva
  //ut dem i html
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['Id'];
    $title = $row['Title'];
    $release = $row['ReleaseYear'];
    $added = $row['DateAdded'];
    $imgurl = $row['ImageUrl'];
    //gör om datum till "rätt" format genom en funktion
    $date = revDate($added);
  }
} else {
  //om inga reusltat hittas i sql frågan skickas man till index
  //med en funktion
  goHome();
}
?>

<!--========================================
  CONTENT
=========================================-->
<!-- skriver ut alla variabler som är satta från det slupmässiga inlägg som hämtades tidigare-->
<div class="content">
  <div class="game-random">
    <div>
      <img src="<?php if (isset($imgurl)) echo $imgurl; ?>" alt="game box art" /><br />
    </div>
    <div>
      <p><?php if (isset($title)) echo $title; ?></p>
      <p><?php if (isset($release)) echo $release; ?></p>
      <p><?php if (isset($added)) echo $date; ?></p>
    </div>
    <input type="button" value="| More Details |" onclick="location.href='details.php?id=<?php echo $id ?>'">
    <input type="button" value="| Go Back |" onclick="location.href='index.php'">
  </div>
</div>
<!--========================================
  FOOTER
=========================================-->
<?php
include "footer.php";
?>