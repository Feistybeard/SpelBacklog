<?php
//ställer in constanten DIR till include mappen
define("DIR", dirname(__FILE__) . "/include/");
//menyn använder sessions för att skriva ut
//lägg till länk och bytta log in till log out
//sen inkluderqas meny i alla sidor så alla sidor
//som behöver kolla sessions har tillgång till sessions
session_start();
?>
<!--========================================
  CONTENT
=========================================-->
<!-- html dokument börjar här och slutar i fotter.php, sedan
inkluderas meny och footer i alla sidor och innehållet på sidorna
skrivs in i mellan inkludering av dessa två för att bygga en komplett
html sida -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <title>SpelBacklog</title>
</head>
<body>
  <div id="navbar">
    <a href="index.php" class="ignore">|Home|</a>
    <a href="random.php" class="ignore">|Randomize|</a>
    <?php
    //om man är inloggad så skrivs loggaut och lägg till länkar
    //annars skrivs login ut
    if (isset($_SESSION['validUser'])) {
      echo '<a href="add.php" class="ignore">|Add New Game|</a>';
      echo '<a href="logout.php" class="ignore">|Log Out|</a>';
    } else {
      echo '<a href="login.php" class="ignore">|Log In|</a>';
    }
    ?>
  </div>
