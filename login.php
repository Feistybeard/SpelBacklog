<!--========================================
  HEADER/MENY
=========================================-->
<?php
//innehåller head och början av html samt menyn till sidan
include "menu.php";
?>

<div class="content">
<?php
$message = "";
/*========================================
  HTTP POST
========================================*/
//kollar om man submitat formuläret och om användarnamn och lösen ord stämmer
//om dem stämmer så skappas en ny session med namn validUser som sedan
//kollas i alla sidor som kräver inloggning, sist så skickas man till index.
// $message användes för att skriva ut om man skrivit fel/inget på textfälten
if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])) {
  if ($_POST['username'] == "marvan" && $_POST['password'] == "pass123") {
    $_SESSION["validUser"] = true;
    echo "<p class=\"login-message\">You Are Now Logged In!</p>";
    echo "<p class=\"login-message\">Redirecting You To Home...</p>";
    header("Refresh: 2; URL = index.php");
  } else {
    $message = "Wrong Username Or Password, Try Again</p>";
  }
} else {
  $message = "Please Type In A Username And Password";
}

/*========================================
  CONTENT
========================================*/
//skriver ut formuläret och validerings felmeddelandet om det finns något
if (!isset($_SESSION['validUser'])) {
  echo '
  <h2>Log In</h2>';
  echo "<p class=\"login-message\">" . $message . '</p><br />';
  echo '
    <form action="" method="post">
    <table>
      <tr>
        <td class="textbox">
          Username<br />
          <input type="text" name="username"><br />
        </td>
      </tr>
      <tr>
        <td class="textbox">
        Password<br />
        <input type="password" name="password">
        </td>
      </tr>
      </table>
      <input type="submit" value="| Log In |" name="submit" />
      <input type="button" value="| Cancel |" onclick="location.href=\'index.php\'" />
    </form>
    ';
}
//om man skriver in adressen till login i webläsaren så visas detta
if (isset($_SESSION['validUser']) && (!isset($_POST['submit']))) {
  echo "You are alredy logged in!<br />";
  echo "<a href=\"logout.php\">|Log Out|</a>";
}
?>
</div>

<!--========================================
  FOOTER
=========================================-->
<?php
include "footer.php"
?>