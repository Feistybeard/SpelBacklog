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
//till variabeln $result
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
  HTTP POST (CR(U)D)
========================================*/
//$message användes senare i html för att skriva ut fel meddelanden
//om sql frågan misslyckas
$message = "";
//om man tryckt på submit knappen och alla fält i formuläret inte är tomma
//så skapas en sql fråga som uppdaterar info i databasen med det man skrivit i formuläret
//sql frågan ändrar endast det inlägg som matchar id:et som användes för att hämta informationen på http get
if (isset($_POST['submit']) && !empty($_POST['title']) && !empty($_POST['release']) && !empty($_POST['imgurl'])) {
  $title = addslashes($_POST['title']);
  $release = $_POST['release'];
  $imgurl = $_POST['imgurl'];
  $sql = "UPDATE spel SET Title = '$title', ReleaseYear = $release, ImageUrl = '$imgurl' WHERE Id = $id";
  $message = updateGame($sql);
  //om sql frågan lyckas visas skickas man till index med en funktion
  if ($message == "Game Updated") goHome();
} else {
  //om man inte fyllt i alla formulärfältt varnas man att göra det
  if (isset($_POST['submit']))
    $message = "Please fill in all of the fields!";
  else
    $message = "";
}
?>

<!--========================================
  CONTENT
=========================================-->
<!-- skriver ut ett formulär i html och sätter value på alla text fält till variablerna
som hämtas i http get, här kollas även att alla fält är ifyllda med javaskipt funkion-->
<div class="content">
  <form action="" method="post" onsubmit="return validateForm()" name="form">
    <h3>Edit <?php if (isset($title)) echo $title; ?></h3>
    <div class="game-info">
      <div>
        <img src="<?php if (isset($imgurl)) echo $imgurl; ?>" alt="game box art" /><br />
      </div>
    </div>
    <table>
      <tr>
        <td class="textbox">
          <br />Title<br /><input type="text" name="title" value="<?php if (isset($title)) echo $title; ?>" />
        </td>
      </tr>
      <tr>
        <td class="textbox">
          Release Year<br /><input type="text" name="release" value="<?php if (isset($release)) echo $release; ?>" />
        </td>
      </tr>
      <tr>
        <td class="textbox">
          Image URL<br /><input type="text" name="imgurl" value="<?php if (isset($imgurl)) echo $imgurl; ?>" />
        </td>
      </tr>
    </table>
    <input type="submit" value="| Update |" name="submit" />
    <input type="button" value="| Go Back |" onclick="location.href='index.php'" />
  </form>
  <?php if (isset($message)) echo $message . '<br />'; ?>
</div>

<?php
include "footer.php";
?>

<!--========================================
  SCRIPT
=========================================-->
<!-- form validering -->
<script src="js/formVal.js"></script>