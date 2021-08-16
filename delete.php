<!--========================================
  HEADER/MENY
========================================-->
<?php
//innehåller head och början av html samt menyn till sidan
include "menu.php";
//innehåller funktioner till sidan bland annat databashantering(CRUD).
//constanten DIR setts i menu.php och pekar på include mappen
include DIR . "func.php";

/*========================================
  HTTP GET
========================================*/
//kollar om man satt variabel id i http get till något och man är inloggad på sidan
//då skickas sql frågan till funktionen getGame som retunerar svaret
//till variabeln $result.
if (isset($_GET['id']) && (isset($_SESSION['validUser']))) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM spel WHERE Id = $id";
  $result = getGame($sql);
  if (mysqli_num_rows($result) > 0) {
    //om resultat av sql frågan innehåller ett inlägg så sparas alla värden
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
    //om inga reusltat hittas i sql frågan skickas man till index
    //med en funktion
    goHome();
  }
} else {
  //om man inte skickat med ett id genom http get eller är inloggad
  //skickas man till index med en funktion
  goHome();
}

/*========================================
  HTTP POST (CRU(D))
========================================*/
//$message användes senare i html för att skriva ut fel meddelanden
//om sql frågan misslyckas
$message = "";
//om man tryckt på submit knappen och sql frågan lyckas
//tas inlägget bort och man redirectas till index annars
//vissas sql felet
if (isset($_POST['submit'])) {
  $sql = "DELETE FROM spel WHERE Id = $id";
  $message = removeGame($sql);
  if ($message == "Game Removed") {
    echo "<div class=\"content\">Deleted $title</div>";
    goHome();
  }
}
?>

<!--========================================
  CONTENT
=========================================-->
<!-- skriver ut alla variabler som är satta, dem sätts i http get när inlägget hämtas -->
<div class="content">
  <form action="" method="post">
    <h3>Delete <?php if (isset($title)) echo $title; ?>?</h3>
    <div class="game-info">
      <div>
        <img src="<?php if (isset($imgurl)) echo $imgurl; ?>" alt="game box art" /><br />
      </div>
      <div>
        <p class="delete-message"><?php if (isset($title)) echo $title; ?></p>
        <p class="delete-message"><?php if (isset($release)) echo $release; ?></p>
        <p class="delete-message"><?php if (isset($added)) echo $date; ?></p>
      </div>
    </div>
    <input type="submit" value="| Delete |" name="submit" />
    <input type="button" value="| Go Back |" onclick="location.href='index.php'" />
  </form>
</div>

<!--========================================
  FOOTER
=========================================-->
<?php
include "footer.php";
?>