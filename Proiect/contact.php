<?php require "mysql.php"; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bus & Train Ticket Booking
    </title>
    <link rel="stylesheet" href="css/styleLog.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js">
    </script>
    <link href="https://fonts.googleapis.com/css?family=Karla&display=swap" rel="stylesheet">
     <script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

  </head>
  <body>
    <section class="top-container">
      <!-- Hamburger Menu -->
      <label for="toggle">
        <i class="fas fa-bars hamburger">
        </i>
      </label>
      <header>
        <nav class="menu main-navigation">
          <h2 id="title">Bus & Train Ticket Booking
          </h2>
          <ul>
            <li>
              <a href="index.php">Home
              </a>
            </li>
            <li>
              <a href="plan.php">Plan Your Trip
              </a>
            </li>
            <li>
              <a href="mybookings.php">Your Bookings
              </a>
            </li>
            <?php
//start session
session_start();
?>
            <?php
//check do the person logged in
if(isset($_SESSION['email'])){
echo '<li>'.
'<a href="logout.php">Hi, '
.$_SESSION['email'] . '</a>'.
'</li>';
$class = 'hidden';
}
else if(!isset($_SESSION['email'])) {
echo   "<button onclick=\"location.href='logare.php';\" type=\"button\" class=\"btn btn-primary\" data-toggle=\" \" data-target=\"\">
Get Started
</button>";
}
?>
          </ul>
        </nav>
        <!-- Small display Responsive Navigation begins -->
        <input type="checkbox" id="toggle" name="toggle">
        <nav class="navigation--responsive">
          <ul>
            <li>
              <a href="index.php">Home
              </a>
            </li>
            <li>
              <a href="plan.php">Plan Trips
              </a>
            </li>
            <li>
              <a href="mybookings.php">Bookings
              </a>
            </li>
            <?php
//check do the person logged in
if(isset($_SESSION['email'])){
echo '<li>'.
'<a href="logout.php">Hi, '
.$_SESSION['email'] . '</a>'.
'</li>';

}
else if(!isset($_SESSION['email'])) {
echo   "<button onclick=\"location.href='logare.php';\" type=\"button\" class=\"btn btn-primary\" style='margin-top: 15px;'>
Get Started
</button>";
}
session_write_close();
?>
          </ul>
        </nav>
      </header>
    </section>
    <script type="text/javascript">

        $(window).scroll(function() {

        if ($(window).width() < 579 || $(window).width() < 980) { <!--doar pentru mobil si tableta -->
          if ($(this).scrollTop() > 0) {
            $(".hide").fadeOut();
          } else {
            $(".hide").fadeIn();
          }
        }


      });
    </script>
    <section class="middle-container">
      <div class='container'>
        <div class='row'>
          <div class='col-md-6' >
            <form method='post' action=''>
              <br>
              <h2>Contact Us
              </h2>
          <div class="form-group">
            <form action="" method="post">
            <textarea id="subject" name="subject" style="height:100px; width: 350px;  color: #999;
              font-family: 'Karla', sans-serif; border: 1px solid #C4C4C4;"></textarea>
            <br> <br>
            <input type="submit" name="submit" value="Submit">
            </form>
            </div>

            <?php

if(isset($_POST['submit'])) {
$id = $_SESSION['id'];
$mesaj = $_POST['subject'];

$sql = "INSERT INTO contact(data, mesaj, id_cont) VALUES(CURDATE(), '$mesaj', '$id')";
if(mysqli_query($conexiune, $sql)) {
  echo "<script>alert('Message send!')</script>";
} else {
  echo "string";
}
}
 ?>



        </div>

    </section>



  </body>
</html>
