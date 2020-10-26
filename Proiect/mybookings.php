<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bus & Train Ticket Booking
    </title>
    <link rel="stylesheet" href="css/style3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <link href="https://fonts.googleapis.com/css?family=Karla&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js">
    </script>
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
echo   "<button onclick=\"location.href='logare.php';\" type=\"button\"  class=\"btn btn-primary\" >
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
?>
          </ul>
        </nav>
      </header>
    </section>
    <section class="middle-container">
      <div class="booking-info-box">
        <h5 id="check-info">Check your booking information
        </h5>
        <form method="post" action"">
          <br>
          <h5 id="show-box">Show
          </h5>
          <select class="chosen-select" name="options">
            <option  value="">
            </option>
            <option  value="past trips">Past trips
            </option>
            <option  value="current trips">Current trips
            </option>
          </select>
          <input type="submit" name="submit" value="Search" class="btn btn-primary btn-sm" style="margin-left: 14px; margin-bottom: 6px;">
        </form action="" method="get">
        <h5 id="demo">
        </h5>
      </div>
      <form  class="table-responsive ">
        <table class="table" style="width: 97%;">
          <thead style="background: #007bff">
            <tr style="color: #fff;">
              <th scope="col">Booking
              </th>
              <th scope="col">Passenger
              </th>
              <th scope="col">From
              </th>
              <th scope="col">To
              </th>
              <th scope="col">Date
              </th>
              <th scope="col">Departure
              </th>
              <th scope="col">Price
              </th>
              <th scope="col">Seat
              </th>
              <th scope="col">Cancel
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">
              </th>
              <?php
require 'mysql.php';
if(isset($_POST['submit']) && isset($_POST['options'])) {
$option = $_POST['options'];
if ($option == 'past trips') {

if(!isset($_SESSION['email'])) {
echo "<h6 style='margin-left: 30px; color: red; font-family: 'Karla', sans-serif;'>No bookings found</h6>";
} if(isset($_SESSION['email'])) {
$id = $_SESSION['id'];


$sql = "SELECT DISTINCT * FROM v_pct_c WHERE data_rezervare < CURDATE()  AND id_cont = $id";
$rezultat = mysqli_query($conexiune, $sql);
if (mysqli_num_rows($rezultat) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($rezultat)) {
echo "<tr>";
echo "<td>" .$row['id_rezervare'] . "</td>";
echo "<td>" . $row["prenume"] . "</td>";
echo "<td>" . $row["origine"] . "</td>";
echo "<td>" . $row["destinatie"] . "</td>";
echo "<td>" . $row["data_rezervare"] . "</td>";
echo "<td>" . $row["plecare"] . "</td>";
echo "<td>" . $row["pret_final"] . "</td>";
echo "<td> 0 </td>";
echo "<td><a href='mybookings.php?id=".$row['id_rezervare']."'>Cancel</a></td>";
echo "</tr>";
}
}}
}if($option == 'current trips') {
if(!isset($_SESSION['email'])) {
echo "<h6 style='margin-left: 30px; color: red; font-family: 'Karla', sans-serif;'>No bookings found</h6>";
} if(isset($_SESSION['email'])) {
$id = $_SESSION['id'];
$sql = "SELECT DISTINCT * FROM v_pct_c WHERE data_rezervare >= CURDATE() AND id_cont = $id";
$rezultat = mysqli_query($conexiune, $sql);
if (mysqli_num_rows($rezultat) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($rezultat)) {
echo "<tr>";
echo "<td>" . $row['id_rezervare'] . "</td>";
echo "<td>" . $row["prenume"] . "</td>";
echo "<td>" . $row["origine"] . "</td>";
echo "<td>" . $row["destinatie"] . "</td>";
echo "<td>" . $row["data_rezervare"] . "</td>";
echo "<td>" . $row["plecare"] . "</td>";
echo "<td>" . $row["pret_final"] . "</td>";
echo "<td> 0 </td>";
echo "<td><a href='mybookings.php?id=".$row['id_rezervare']."'>Cancel</a></td>";
echo "</tr>";
} }
}
}} if($_GET) {
$id_rezervare = $_GET['id'];
$id_plata= "SELECT id_plata FROM plata WHERE id_rezervare = $id_rezervare";
$rezultat = mysqli_query($conexiune, $id_plata);
$row = mysqli_fetch_assoc($rezultat);
$post_numbers = $row['id_plata'];
$delete = mysqli_query($conexiune,"CALL delete_rezervare('$post_numbers', '$id_rezervare')");
if($delete)
{
mysqli_close($conexiune);
header("location: mybookings.php", true);
}
else
{
echo "Error deleting record";
}
}

?>
            </tr>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
<?php
if(isset($_POST['plata_efectuata'])) {
require 'mysql.php';
$id = $_SESSION['id'];
$pret = $_POST['hidden_price'];
$numar = $_POST['cc'];
$numar_exp = $_POST['cc-exp'];
$numar_cvc = $_POST['cc-cvc'];
$sql2 = "SELECT id_rezervare FROM rezervare ORDER BY id_rezervare DESC LIMIT 1";
$rezultat = mysqli_query($conexiune, $sql2);
$row = mysqli_fetch_assoc($rezultat);
$post_numbers = $row['id_rezervare'];


$sql = "INSERT INTO plata (card_numar, data_expirare, cod_securitate, pret_final, id_rezervare) VALUES($numar, $numar_exp, $numar_cvc, $pret, $post_numbers)";
if(mysqli_query($conexiune, $sql)) {
echo "<script>alert('Payment made! Thank you!')</script>";
} else {
echo "Eroare";
}
} ?>

</body>
</html>
