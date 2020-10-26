m<?php
require 'mysql.php';

session_start();

$email = $_POST['email'];
$parola = $_POST['password'];
$parola = md5($parola);

$sql = "SELECT * FROM cont WHERE email = '$email' && parola = '$parola'";
$rezultat = mysqli_query($conexiune, $sql);
$num = mysqli_num_rows($rezultat);

if($num > 0 ){

  $row = mysqli_fetch_assoc($rezultat);
  $_SESSION['email'] = $row["nume"];
  $_SESSION['id'] = $row["id_cont"];
  header('location: index.php');

}
else {
  echo "Eroare";
}

 ?>
