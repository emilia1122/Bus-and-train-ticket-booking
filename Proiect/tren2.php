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
      <section class="middle-container">

        <?php echo '<h5 style="margin-left: 52px; margin-top: 40px; margin-botton: 40px;">Ati ales trenul '. $_POST["hidden_name"]. '</h5>';
?>
        <section class="bottom-container">
          <aside class="final-check">
            <div class="boarding-point">
              <h6 id="boarding">Boarding point
              </h6>
              <h6 style="margin-left: 11px;">
                <?php echo $_POST["hidden_origine"];?>
              </h6>
            </div>
            <div class="dropping-point">
              <h6 id="dropping">Dropping point
              </h6>
              <h6 style="margin-left: 11px;">
                <?php echo $_POST["hidden_destinatie"];?>
                </div>
              <div class="displayerBoxes">
                <div class="seat-numbers"
                     <table class="Displaytable">
                <th>
                  <h6 style="padding-left: 22px;">Seat
                  </h6>
                </th>
                <tr>
                  <td>

                    <div id="seatsDisplay">
                      <?php if(isset($_POST['submit'])) {
                        $loc = $_POST['check'];
                        echo $loc;
                      }else {
                        echo "";
                      } ?>
                    </div>
                  </td>
                </tr>
                </table>
            </div>
            <div class="total-price">
              <h6>
                <?php echo $_POST['hidden_price'] . ' '. 'Lei'?>
              </h6>
            </div>
            <div class="finish-search">
              <form method="post" action="plata_online.php">
                <input type="hidden" name="id_tren" value="<?php echo $_GET['id']; ?>">
                <input type="hidden" name="hidden_price" value="<?php echo $_POST['hidden_price']; ?>">
                <input type="submit" name="continue" class="btn btn-primary btn-lg btn-block" value="Continue">
                </input>
              </form>
            </div>
          </div>
        </aside>
      <div class="select-seat">
        <div onload="onLoaderFunc()">
          <div class="inputForm">
            <br>
            <div class="passengers-seat-select">
            <br> <br> <br>
              <!--<button onclick="takeData()">Start Selecting
</button>-->
            </div>
          </div>
          <?php
include 'mysql.php';
$subjectName = "SELECT * FROM loc";
$subject = mysqli_query($conexiune, $subjectName);
?>
          <form class="seatStructure" method="post" action="">
            <div class="left" style="width: 300px;">
              <table id="seatsBlock" style="margin-left: 32px; margin-right: 30px; margin-top: 25px;">
                <tr>
                  <td>
                    <?php
while($data = mysqli_fetch_array($subject)) {
echo "<input type='checkbox' name='check' value='{$data['loc']}'>";
}
?>

                  </td>
                </tr>
              </table>
              <br />
              <br>

              <input type="hidden" name="id_tren" value="<?php echo $_POST['id_tren']; ?>">
              <input type="submit"  name="submit" value="Confirme Selection">
              </input>
            </div>
            </from>
          <br />
          <br />
        </div>
        </section>

    </section>
    </section>
