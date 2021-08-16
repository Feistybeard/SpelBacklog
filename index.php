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
//sätter variablerna $sortby och $sortdir genom http get
//om dem inte är satta (vid start av sidan) så sorteras
//inläggen efter titel stigande
if (isset($_GET['sortby']) && (isset($_GET['sortdir']))) {
  $sortby = $_GET['sortby'];
  $sortdir = $_GET['sortdir'];
} else {
  $sortby = "title";
  $sortdir = "asc";
}
?>

<!--========================================
  CONTENT (C(R)UD)
========================================-->
<div class="content">
  Sort By:
  <?php
  //skickar två variabel i länkarna som kollas i HTTP GET
  //switch sats kollar sedan $sortby och om $sortdir är stigande eller nedåtgående
  //och ändrar länkarna med pil up/ner beroende på vad man valt innan dem användes
  //sedan för att sortera sql frågan till databasen.
  switch ($sortby) {
    case "title":
      if ($sortdir == "asc") {
        echo "<a href=\"?sortby=title&sortdir=desc\">Title &ShortUpArrow; | </a>";
        echo "<a href=\"?sortby=release&sortdir=asc\">Release Year | </a>";
        echo "<a href=\"?sortby=added&sortdir=asc\">Date Added</a>";
      } else {
        echo "<a href=\"?sortby=title&sortdir=asc\">Title &ShortDownArrow; | </a>";
        echo "<a href=\"?sortby=release&sortdir=asc\">Release Year | </a>";
        echo "<a href=\"?sortby=added&sortdir=asc\">Date Added</a>";
      }
      break;
    case "release":
      if ($sortdir == "asc") {
        echo "<a href=\"?sortby=title&sortdir=asc\">Title | </a>";
        echo "<a href=\"?sortby=release&sortdir=desc\">Release Year &ShortUpArrow; | </a>";
        echo "<a href=\"?sortby=added&sortdir=asc\">Date Added</a>";
      } else {
        echo "<a href=\"?sortby=title&sortdir=asc\">Title | </a>";
        echo "<a href=\"?sortby=release&sortdir=asc\">Release Year &ShortDownArrow; | </a>";
        echo "<a href=\"?sortby=added&sortdir=asc\">Date Added</a>";
      }
      break;
    case "added":
      if ($sortdir == "asc") {
        echo "<a href=\"?sortby=title&sortdir=asc\">Title | </a>";
        echo "<a href=\"?sortby=release&sortdir=asc\">Release Year | </a>";
        echo "<a href=\"?sortby=added&sortdir=desc\">Date Added &ShortUpArrow;</a>";
      } else {
        echo "<a href=\"?sortby=title&sortdir=asc\">Title | </a>";
        echo "<a href=\"?sortby=release&sortdir=asc\">Release Year | </a>";
        echo "<a href=\"?sortby=added&sortdir=asc\">Date Added &ShortDownArrow;</a>";
      }
      break;
  }
  ?>

  <div class="items-section">
    <?php
    //en switch satts som kollar vilken sortering som gäller just nu och sätter en ny variable $sortBy för att matcha
    //kolumn namn i tabelen.
    switch ($sortby) {
      case "title":
        $sortBy = "Title";
        break;
      case "release":
        $sortBy = "ReleaseYear";
        break;
      case "added":
        $sortBy = "DateAdded";
        break;
    }
    //frågan till databasen som skickas till en funktion som retunerar svaret till $result variabeln
    $sql = "SELECT * FROM spel ORDER BY $sortBy $sortdir";
    $result = getGame($sql);
    if (mysqli_num_rows($result) > 0) {
      //om resultat utav sql frågan har mer än ett inlägg så hämtar vi alla inläggen
      //och skriver ut dem i html, vi sätter även till en länk som skickar dig vidare
      //till mer detaljer och två knappar som länkar till redigering och tabort för inlägget
      //som hämtas just nu i loopen
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['Id'];
        $title = $row['Title'];
        $release = $row['ReleaseYear'];
        $added = $row['DateAdded'];
        $imgurl = $row['ImageUrl'];
        echo "
        <div class=\"item\">
          <a href=\"details.php?id=$id\">
            <img src=\"$imgurl\" alt=\"game box art\" /><br />
            <p>$title</p>
            <p>$release</p>
          </a>";
        if (isset($_SESSION['validUser'])) {
          echo "<input type=\"button\" value=\"| Edit |\" onclick=\"location.href='edit.php?id=$id'\" />";
          echo "<input type=\"button\" value=\"| Delete |\" onclick=\"location.href='delete.php?id=$id'\" />";
        }
        echo "
        </div>
        ";
      }
    }
    //efter loopen kollar vi om man är inloggad på sidan för att skriva utt en lägg till "knapp"
    if (isset($_SESSION['validUser'])) {
      echo "
          <div class=\"item\">
            <a href=\"add.php\">
              <img src=\"./images/addnew.png\" alt=\"add new game\" />
              <p>Add New Game</p>
            </a>
          </div>
          ";
    }
    ?>
  </div>
</div>


<!--========================================
  FOOTER
========================================-->
<?php
  include "footer.php";
?>