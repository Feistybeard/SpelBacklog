<?php

//funktion för att lägga till ett inlägg i databasen
function addGame($query)
{
  include DIR . "db.php";
  if (mysqli_query($conn, $query)) {
    return "Game Added";
  } else {
    $error = "Error: " . $query . "<br />" . mysqli_error($conn);
    return $error;
  }
  mysqli_close($conn);
}

//funktion för att hämta ett inlägg från databasen
function getGame($query)
{
  include DIR . "db.php";
  $res = mysqli_query($conn, $query);
  if ($res) {
    return $res;
  } else {
    $error = "Error: " . $query . "<br />" . mysqli_error($conn);
    return $error;
  }
  mysqli_close($conn);
}

//funktion för att uppdatera ett inlägg i databasen
function updateGame($query)
{
  include DIR . "db.php";
  $res = mysqli_query($conn, $query);
  if ($res) {
    return "Game Updated";
  } else {
    $error = "Error: " . $query . "<br />" . mysqli_error($conn);
    return $error;
  }
  mysqli_close($conn);
}

//funktion för att tabort ett inlägg i databasen
function removeGame($query)
{
  include DIR . "db.php";
  $res = mysqli_query($conn, $query);
  if ($res) {
    return "Game Removed";
  } else {
    $error = "Error: " . $query . "<br />" . mysqli_error($conn);
    return $error;
  }
  mysqli_close($conn);
}

//redirectar till index
function goHome()
{
  header("Refresh: 2; URL = index.php");
  // echo "<script type=\"text/javascript\">
  //       window.location = \"index.php\"
  //       </script>";
}

//ändrar formatet på datum till dag/månad/år
function revDate($date)
{
  $dateString = strtotime($date);
  $dateReversed = date("d-m-Y", $dateString);
  return $dateReversed;
}

?>