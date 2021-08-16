<!--========================================
  HEADER/MENY
========================================-->
<?php
//innehåller head och början av html samt menyn till sidan
include "menu.php";
?>

<!--========================================
  CONTENT
=========================================-->
<div class="content">
<?php
//om session validUser är satt(man är inloggad på sidan) så tas sessionen bort och
//man redirectas till index, annars vi är man inte inloggad och redirectas till index
if (isset($_SESSION['validUser'])) {
  unset($_SESSION['validUser']);
  echo "<p class=\"login-message\">You Are Now Logged Out!</p>";
  echo "<p class=\"login-message\">Redirecting You To Home...</p>";
  header("Refresh: 2; URL = index.php");
} else {
  echo "<p class=\"login-message\">You Are Not Logged In</p>";
  echo "<p class=\"login-message\">Redirecting You To Home...</p>";
  header("Refresh: 2; URL = index.php");
}
?>
</div>

<!--========================================
  FOOTER
=========================================-->
<?php
include "footer.php";
?>