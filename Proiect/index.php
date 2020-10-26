<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bus & Train Ticket Booking
    </title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js">
    </script>
    <link href="https://fonts.googleapis.com/css?family=Karla&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
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
    <!-- End top-container-section -->
    <section class="middle-left-container">
      <div class="form">
        <div class="row bus-train" style="margin-left: 46px;">
          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#cust" role="tab" aria-selected="true">
                Bus
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#rest" role="tab">
                Train
              </a>
            </li>
          </ul>
        </div>
        <div class="row" style="
                                margin-left: 50px;
                                margin-top: 35px;">
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
          <div class="col">
            <div class="field">
              <label for="from">From
              </label>
              <input id="from" type="text" name="origine" value="" autocomplete="off"  />
            </div>
          </div>
          <div class="col">
            <div class="field">
              <label for="to">To
              </label>
              <input id="to" type="text" name="destinatie" value="" autocomplete="off"  />
            </div>
            <div class="row">
              <div class="col-4" style="margin-left: 50px;">

                <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                  <input type="text" name="when" class="form-control datetimepicker-input" data-target="#datetimepicker8" style="padding-left: 5px; height: 60px;">
                  <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                    <div class="input-group-text">
                      <i class="fa fa-calendar">
                      </i>
                    </div>
                  </div>

                </div>
              </div>
              <!-- merge doar pt one way -->
            <!-- <div class="col-4 col-resp">
                <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker8" style="padding-left: 5px; height: 60px; ">
                  <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                    <div class="input-group-text">
                      <i class="fa fa-calendar">
                      </i>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="clearfix visible-xs">
            </div>
            <div class="field">
              <button type="submit" name="submit" value="Search" id="button-search" class="btn btn-primary" data-toggle=" " data-target="#exampleModal">Search
              </button>

            </div>

          </div>
        </form>
      </div>
    <a id="a" href="contact.php"> <p>Contact Us
      </p>
    <?php
      //if(isset($_SESSION['email'])) {
        //require 'mysql.php';
        //$id = $_SESSION['id'];
          //$sql = "SELECT data_rezervare from rezervare where id_cont = $id order by data_rezervare asc limit 1";
          //$rezultat = mysqli_query($conexiune, $sql);
          //$row = mysqli_fetch_assoc($rezultat);
          //$post_numbers = $row['data_rezervare'];

          //$result = mysqli_query($conexiune, "SELECT mesaj_reamintire_rezervare('$post_numbers') AS 'mesaj'"); //apel functia stocata mysql
          //$row = mysqli_fetch_assoc($result);
          //$F = $row['mesaj'];

         //echo "<script>alert('$F')</script>";
      //}

       ?>


    </section>
    <section class="middle-right-container">
      <div class="row">
        <div class="col">

          <img src="images/calatori.png" alt="2-calatori">

        </div>
      </div>

    </section>



    <script src="JS/index.js">

    </script>



  </body>
</html>
