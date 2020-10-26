<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Bus & Train Ticket Booking
    </title>
    <link rel="stylesheet" href="css/tren.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js">
    </script>
    <link href="https://fonts.googleapis.com/css?family=Karla&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <!-- pentru datepicker -->
  </head>
  <body>
    <section class="top-container">
      <!-- Hamburger Menu -->
      <label for="toggle">
        <i class="fas fa-bars hamburger hide">
        </i>
      </label>
      <header>
        <nav class="menu main-navigation">
          <h2>Bus & Train Ticket Booking
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
            <?php require "mysql.php"; ?>
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
?>
          </ul>
        </nav>
        <script>
          $(window).scroll(function() {
            if ($(window).width() < 579 || $(window).width() < 980) {
              <!--doar pentru mobil si tableta -->
                if ($(this).scrollTop() > 0) {
                  $(".hide").fadeOut();
                }
              else {
                $(".hide").fadeIn();
              }
            }
          }
                          );
        </script>
      </header>
    </section>
    <!-- End top-container-section -->
    <section class="middle-container">
      <div class="form">
        <div class="row" id="radio">
          <!-- Default inline 1-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="defaultInline1" name="inlineDefaultRadiosExample">
            <label class="custom-control-label" for="defaultInline1">One way
            </label>
          </div>
          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="defaultInline2" name="inlineDefaultRadiosExample">
            <label class="custom-control-label" for="defaultInline2">Round trip
            </label>
          </div>
        </div>
        <form class="row" action="tren.php" method="post">
          <div class="col-sm-3">
            <div class="field">
              <label for="from">From
              </label>
              <input id="from" type="text" name="origine" />
            </div>
          </div>
          <div class="col-sm-3">
            <div class="field to-field">
              <label for="to">To
              </label>
              <input id="to" type="text" name="destinatie"/>
            </div>
          </div>
          <div class="col-resp">
            <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
              <input type="text" name="when" class="form-control datetimepicker-input" data-target="#datetimepicker8" style="margin-top: 10px; padding-left: 5px; height: 66px;">
              <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                <div class="input-group-text" style="margin-top: 10px;">
                  <i class="fa fa-calendar">
                  </i>
                </div>
              </div>
            </div>
          </div>
        <!--  <div class="col-resp-2">
            <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker8" style="margin-top: 10px; padding-left: 5px; height: 66px; ">
              <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                <div class="input-group-text" style="margin-top: 10px;">
                  <i class="fa fa-calendar">
                  </i>
                </div>
              </div>
            </div>
          </div> -->
          <button type="submit" name="submit2" class="btn btn-primary col-resp-3" data-toggle=" " data-target="#exampleModal">Search
          </button>
        </form>
      </div>
      <section class="train-details">
        <?php
if(isset($_POST['submit'])) {

$_SESSION['origine'] = $_POST["origine"];
$from = $_SESSION["origine"];
$_SESSION['destinatie'] = $_POST["destinatie"];
$to = $_SESSION["destinatie"];
$_SESSION['when'] = $_POST["when"];
$date = $_SESSION["when"];
$nameOfDay =  date('D', strtotime($date));

$result = mysqli_query($conexiune, "SELECT transforma_prima_litera('$from') AS 'str'"); //apel functia stocata mysql
$row = mysqli_fetch_assoc($result);
$From = $row['str'];

$result = mysqli_query($conexiune, "SELECT transforma_prima_litera('$to') AS 'str'"); //apel functia stocata mysql
$row = mysqli_fetch_assoc($result);
$To = $row['str'];

$sql1 = "SELECT * FROM v_pct_a
WHERE
origine = '$From' AND destinatie = '$To' AND ziua = '$nameOfDay'";
$rezultat = mysqli_query($conexiune, $sql1) or die ('Eroare');

if (mysqli_num_rows($rezultat) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($rezultat)) {
?>

        <div class="found-trains">
          <form method="post" action="tren2.php?action=add&id=<?php echo $row["id_tren"]; ?>">
            <div>
              <h5 id="train-no"><?php echo $row['origine'].' - '. $row['destinatie'] .'
                <br/>' . $row['nume']; ?></h5>
              <h5 id="seat-no">Duration
                <span><?php echo $row['durata']. 'h';  ?></span>
              </h5>
              <h5 id="time-train">Departure
                - Arrival
                <br/><?php echo $row['plecare']. ' '.'----->'. ' '. $row['sosire'];?></h5>
              <h5 id="price-train">Price
                <span><?php echo $row['pret'].' Lei';?></span>
              </h5>
              <input type="hidden" name="hidden_name" value="<?php echo $row["nume"]; ?>">
              <input type="hidden" name="hidden_price" value="<?php echo $row["pret"]; ?>">
              <input type="hidden" name="hidden_origine" value="<?php echo $row["origine"]; ?>">
              <input type="hidden" name="hidden_destinatie" value="<?php echo $row["destinatie"]; ?>">
              <input type="hidden" name="hidden_ruta" value="<?php echo $row["id_ruta"]; ?>">
              <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-light button-seat"
                     value="Select">
            </div>
          </form>
        </div>
        <?php
}
}
else {


  echo '<h5 style="margin-left: 52px;">Nu aveti tren!</h5>';

} } if(isset($_POST['submit2'])){
  date_default_timezone_set("Europe/Bucharest");
  $date_plecare = date('H:i');
  $_SESSION['origine'] = $_POST["origine"];
  $from = $_SESSION["origine"];
  $_SESSION['destinatie'] = $_POST["destinatie"];
  $to = $_SESSION["destinatie"];
  $_SESSION['when'] = $_POST["when"];
  $date = $_SESSION["when"];
  $nameOfDay =  date('D', strtotime($date));

  $now = date('l'); // numele zilei curente
  $result = mysqli_query($conexiune, "SELECT transforma_prima_litera('$from') AS 'str'"); //apel functia stocata mysql
  $row = mysqli_fetch_assoc($result);
  $From = $row['str'];

  $result = mysqli_query($conexiune, "SELECT transforma_prima_litera('$to') AS 'str'"); //apel functia stocata mysql
  $row = mysqli_fetch_assoc($result);
  $To = $row['str'];



  $sql1 = "SELECT * FROM v_pct_a
  WHERE
  origine ='$From' AND destinatie = '$To' AND ziua = '$nameOfDay'";
  $rezultat = mysqli_query($conexiune, $sql1) or die ('Eroare');
  if (mysqli_num_rows($rezultat) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($rezultat)) {
  ?>
          <div class="found-trains">
            <form method="post" action="tren2.php?action=add&id=<?php echo $row["id_tren"]; ?>">
              <div>
                <h5 id="train-no"><?php echo $row['origine'].' - '. $row['destinatie'] .'
                  <br/>' . $row['nume']; ?></h5>
                <h5 id="seat-no">Duration
                  <span><?php echo $row['durata']. 'h';?></span>
                </h5>
                <h5 id="time-train">Departure
                  - Arrival
                  <br/><?php echo $row['plecare']. ' '.'----->'. ' '. $row['sosire'];?></h5>
                <h5 id="price-train">Price
                  <span><?php echo $row['pret'].' Lei';?></span>
                </h5>
                <input type="hidden" name="hidden_name" value="<?php echo $row["nume"]; ?>">
                <input type="hidden" name="hidden_price" value="<?php echo $row["pret"]; ?>">
                <input type="hidden" name="hidden_origine" value="<?php echo $row["origine"]; ?>">
                <input type="hidden" name="hidden_destinatie" value="<?php echo $row["destinatie"]; ?>">
                <input type="hidden" name="hidden_ruta" value="<?php echo $row["id_ruta"]; ?>">
                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-light button-seat"
                       value="Select">
              </div>
            </form>
          </div>
          <?php
  }
  }
  else {
    echo '<h5 style="margin-left: 52px;">Nu aveti tren!</h5>';

  }}
?>
<script src="JS/index.js">
</script>
</body>
</html>
