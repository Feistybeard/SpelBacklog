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
  HTTP POST  ((C)RUD)
========================================*/
//$message användes sedan i html för att skriva ut fel meddelanden
//om man inte fyllt i formuläret korrekt eller sql frågan misslyckas
$message = "";
//kollar om man submitat formuläret och att alla fält är ifyllda
if (isset($_POST['submit']) && !empty($_POST['title']) && !empty($_POST['release']) && !empty($_POST['imgurl'])) {
  //lägger till slash framför special teken i titeln annars klagar mysql
  $title = addslashes($_POST['title']);
  $release = $_POST['release'];
  //samma som i titel
  $imgurl = addslashes($_POST['imgurl']);

  //sql frågan som skicak till funktionen addGame som retunerar om den lyckades
  //till variabeln $message.
  $sql = "INSERT INTO spel (Title, ReleaseYear, DateAdded, ImageUrl)
          VALUES ('$title', $release, DATE(NOW()), '$imgurl')";
  $message = addGame($sql);
} else {
  //om man inte fyllt i alla fälten i formuläret och javascript inte funkar
  if (isset($_POST['submit']))
    $message = "Please Fill In All Of The Fields!";
  else
    $message = "";
}

/*=========================================
  CONTENT
=========================================*/
//om man är inloggad så skrivs formuläret ut och action är tom för att
//http post postar till samma fil, här kollas även att alla fält är i fyllda
//med javaskipt funkion
if (isset($_SESSION['validUser'])) {
  echo "
  <div class=\"content\">
    <div>
      <form onsubmit=\"return validateForm()\" action=\"\" method=\"post\" name=\"form\">
        <h3>Add New Game</h3>
        <table>
          <tr>
            <td></td>
            <td class=\"textbox\">Title<br /><input type=\"text\" name=\"title\" id=\"title\"></td>
          </tr>
          <tr>
            <td></td>
            <td class=\"textbox\">Release Year<br /><input type=\"text\" name=\"release\" id=\"release\"></td>
          </tr>
          <tr>
            <td></td>
            <td class=\"textbox\">Image URL<br /><input type=\"text\" name=\"imgurl\" id=\"imgurl\"></td>
          </tr>
        </table>
        <input type=\"submit\" value=\"| Add |\" name=\"submit\">
        <input type=\"button\" value=\"| Go Back |\" onclick=\"location.href='index.php'\">
      </form>
      $message
    </div>
  </div>
  ";
  //annars redirectas man till login sidan
} else {
  echo "
  <div class=\"content\">
    <p>Please Sign In First</p>
    <p>Redirecting You To Log In Page...</p>
  </div>
  ";
  header("Refresh: 2; URL = login.php");
}

/*========================================
  FOOTER
========================================*/
include "footer.php";
?>

<!--========================================
  SCRIPT
========================================-->
<!-- form validering -->
<script src="js/formVal.js"></script>