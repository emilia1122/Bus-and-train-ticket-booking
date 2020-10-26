<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bus & Train Ticket Booking
    </title>
    <link rel="stylesheet" href="css/style4.css">
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
session_start();
?>
            <?php
//check do the person logged in
if(isset($_SESSION['id'])){
echo '<li>'.
'<a href="logout.php">Hi, '
.$_SESSION['email'] . '</a>'.
'</li>';
$class = 'hidden';
}
else if(!isset($_SESSION['email'])) {
echo   "<button onclick=\"location.href='logare.php';\" type=\"button\" class=\"btn btn-primary\">
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
$class = 'hidden';
}
else if(!isset($_SESSION['email'])) {
echo   "<button onclick=\"location.href='logare.php';\" type=\"button\" class=\"btn btn-primary\" style='margin-top: 15px;'>
Get Started
</button>";
}
?>
          </ul>
        </nav>
        <script type="text/javascript">
          $(window).scroll(function() {
            if ($(this).scrollTop() > 0) {
              $(".hide").fadeOut();
            }
            else {
              $(".hide").fadeIn();
            }
          }
                          );
        </script>
      </header>
    </section>
    <section class="middle-container">
      <div class="container">
        <div class="card-deck">
          <div class="card text-center">
            <div class="card-block">
              <h4 class="card-title">Youth Discounts
              </h4>
              <p class="card-text">
                Apply for exclusive youth discounts
                <br> View existing discounts
                <br> Activate and save money
                <br>
              </p>
            </div>
            <div class="card-footer">
              <div class="modal fade testmodal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Youth Discounts
                      </h4>
                      <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                    </div>
                    <div class="modal-body">
                      <p>As a student exploring the world and learning new things in life is far more interesting and simple than ever. There are endless opportunities and much more discounts. Sort out your travel in a little pocket money and now
                        all
                        you need is the passion for adventure.
                        With the 16-24 Saver card,
                        <span style="color: red;">teens aged 16 and 24 will get 50% off travel,
                        </span> meaning they pay the same for tickets as children aged 15 and under.
                        Train operators believe passengers will save an average of 186 Lei per year on journeys to school, college, work and leisure trips by using the 16-24 Saver. The discount will apply to most fares, including peak and season
                        tickets.
                        This new 16-24 Saver will offer real money saving benefits to 1.2 million 16 to 24-year-olds and their families.
                        Whether it’s going to your dream music festival or visiting the family — get closer to what matters most.
                      </p>
                    </div>
                    <form action="plan.php" method="post">
                      <label>Age:
                      </label>
                      <input name="varsta" class="col-md-2" type="text"/>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                        </button>
                        <button type="submit" name="age1"class="btn btn-primary">Get discount
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="btn btn-primary show-modal element">Find More
              </div>
            </div>
          </div>
          <!--end youth discounts-->
          <div class="card text-center">
            <div class="card-block">
              <h4 class="card-title">Adult Discounts
              </h4>
              <p class="card-text" >
                Apply for exclusive adult dicounts
                <br> View existing discounts
                <br> Activate and save money
                <br>
              </p>
            </div>
            <div class="card-footer">
              <div class="modal fade testmodal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Adult Discounts
                      </h4>
                      <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                    </div>
                    <div class="modal-body">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        <span style="color: red;">Adults aged 25 and 49 will get 10% off travel.
                        </span>
                      </p>
                    </div>
                    <form action="plan.php" method="post">
                      <label>Age:
                      </label>
                      <input name="varsta" class="col-md-2" type="text"/>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                        </button>
                        <button type="submit" name="age"class="btn btn-primary">Get discount
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="btn btn-primary show-modal element">Find More
              </div>
            </div>
          </div>
          <!--end senior discounts-->
          <div class="card text-center">
            <div class="card-block">
              <h4 class="card-title">Senior Discounts
              </h4>
              <p class="card-text">
                Apply for exclusive senior dicounts
                <br> View existing discounts
                <br> Activate and save money
                <br>
              </p>
            </div>
            <div class="card-footer">
              <div class="modal fade testmodal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" >Senior Discounts
                      </h4>
                      <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                    </div>
                    <div class="modal-body">
                      <p>Getting old has few benefits, but the occasional senior travel discount is one of them. Senior travelers can enjoy a wide range of discounts, but both availability and value vary substantially among different travel sectors
                        and
                        in different parts of the globe.
                        Saving up for a trip can be difficult in your later years when you’re living on a fixed income or relying on savings; however, it’s not impossible. 
                        Age is just a number, except for when it comes to claiming senior discounts. While there’s no one set age at which you qualify, most companies start providing senior discounts to people in their early to
                        <span style="color: red;">50's.
                        </span> 
                        Economy and compact cars can range from 45 Lei to 65 Lei per day.
                        <span style="color: red;">With a 25% discount, you could save a total of 56.25 Lei to 81.25 Lei during a five-day trip.
                        </span>
                      </p>
                    </div>
                    <form action="plan.php" method="post">
                      <label>Age:
                      </label>
                      <input name="varsta" class="col-md-2" type="text"/>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                        </button>
                        <button type="submit" name="age3"class="btn btn-primary">Get discount
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="btn btn-primary show-modal element">Find More
              </div>
            </div>
          </div>
        </div>
        <!--end kids discounts-->
        <div class="card-deck mt-4">
          <div class="card text-center">
            <div class="card-block">
              <h4 class="card-title">Sustainable Travel
              </h4>
              <p class="card-text">
                Inspirational ideas to help you travel sustainably
                <br>How to be an eco-conscious traveler
                Encouraging others to embrace sustainable travel
                <br>
                Fuel Your Wanderlust
              </p>
            </div>
            <div class="card-footer">
              <div class="modal fade testmodal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" >Sustainable Travel
                      </h4>
                      <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                    </div>
                    <div class="modal-body">
                      <p>Solving climate change requires reducing carbon emissions. When you offset your footprint, you neutralize your emissions by protecting forests that absorb carbon from the atmosphere.
                        Protecting forests and other natural ecosystems is one of the fastest and most effective ways to curb global climate change. 
                        Many of us are fortunate enough to enjoy traveling to new places, whether it be local or international. 
                        Given our love for travel and desire to be more sustainable here’s some eco-friendly traveling tips and tricks we’ve picked up (and packed up) along the way:
                        -Opt for sustainable hotels and eco-friendly accommodation
                        -Invest in a water purification device
                        -Choose a destination that values sustainability
                        -Support local economies, and opt for sustainable activities
                        -Leave a place better than you found it
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="btn btn-primary show-modal element">Find More
              </div>
            </div>
          </div>
          <!--end sustainable travel-->
          <div class="card text-center">
            <div class="card-block">
              <h4 class="card-title">Budget Travel Tips
              </h4>
              <p class="card-text">
                How to travel on a budget
                <br>Inspiring ideas for budget travel that will help you save money, have a cheap holiday and show you don't need to splash cash to have amazing experiences
                <br>There is honor in ultra-budget travel.
              </p>
            </div>
            <div class="card-footer">
              <div class="modal fade testmodal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Budget Travel Tips
                      </h4>
                      <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                    </div>
                    <div class="modal-body">
                      <p>If you’re missing the road, what better time than now to begin preparations for the next great adventure? But before you get too far into your planning, be sure to check out these great tips and websites to avoid paying too
                        much. These will make saving cash a breeze!
                        <br>
                        1. Stay far away from touristy restaurants and instead go down a few blocks and eat where the locals do.
                        <br>
                        2. Travel during the low-peak season and avoid traveling during the summer and around holidays.
                        <br>
                        3. If you’re traveling between countries, try to do as much buying of needed items as possible in the cheaper countries where your dollar can stretch farther, then avoid the souvenirs in the more expensive ones.
                        <br>
                        4. Plan out your day so you know where your money will be going. You don’t have to plan the whole trip, but looking over your day in the morning is a great way to cut costs.
                        <br>
                        5. Get travel insurance before you leave. While it does cost money, it’s totally worth it if you get injured, and can end up saving you a lot in the long run.
                        <br>
                        6. If you’re traveling by train, take the night train. It will save on accommodation and once you’re used to it, sleeping won’t be a problem on them.
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="btn btn-primary show-modal element">Find More
              </div>
            </div>
          </div>
          <!--end budget travel -->
          <div class="card text-center">
            <div class="card-block">
              <h4 class="card-title">Bus Travel vs Train Travel
              </h4>
              <p class="card-text">
                “The journey of a thousand miles begins with a single step.” ― Lao Tzu
                <br>
                Wondering about public transport in Romania?
                <br>Which is the least expensive way to travel?
                <br>This guide breaks down the pros and cons of bus vs train
              </p>
            </div>
            <div class="card-footer">
              <div class="modal fade testmodal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Bus Travel vs Train Travel
                      </h4>
                      <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                    </div>
                    <div class="modal-body">
                      <p>There are many different ways to travel, and there isn’t always one option that is best for everyone. For many people, however, it’s better to travel by bus vs train. 
                        Explore the reasons why some people prefer the bus and some people prefer the train.
                        <br>
                        BUS TRAVEL PROS:
                        <br>
                        1) Bus Travel is Often Cheaper
                        <br>
                        2) Buses Take You Right to Your Destination
                        <br>
                        3) Buses Can Deliver a More Comfortable Journey
                        <br>
                        4) Buses Are Often Quieter for Passengers
                        <br>
                        TRAIN TRAVEL PROS:
                        <br>
                        1.You can get up and move around
                        <br>
                        2.You can lay down flat and get a good nights sleep on a train
                        <br>
                        3.Trains are more environmentally friendlys
                        <br>
                        4.Trains offer more amenities
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="btn btn-primary show-modal element" style=" margin-bottom: 0;">Find More
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--end bus vs train-->
      <?php
if(isset($_SESSION['email'])) {
if(isset($_POST['age1'])) {
require 'mysql.php';
$age = $_POST['varsta'];
$id = $_SESSION['id'];
$sql1 = "UPDATE cont SET varsta = $age
WHERE id_cont = $id";
$result = mysqli_query($conexiune, $sql1);
if($result) {
echo "<script>alert('Age added!')</script>"; } else {echo "Error";}
}if(isset($_POST['age'])) {
require 'mysql.php';
$age = $_POST['varsta'];
$id = $_SESSION['id'];
$sql1 = "UPDATE cont SET varsta = $age
WHERE id_cont = $id";
$result = mysqli_query($conexiune, $sql1);
if($result) {
echo "<script>alert('Age added!')</script>"; } else {echo "Error";}
}if(isset($_POST['age3'])) {
require 'mysql.php';
$age = $_POST['varsta'];
$id = $_SESSION['id'];
$sql1 = "UPDATE cont SET varsta = $age
WHERE id_cont = $id";
$result = mysqli_query($conexiune, $sql1);
if($result) {
echo "<script>alert('Age added!')</script>"; } else {echo "Error";}
}
} else {
echo "<script>alert('For discount register first!')</script>";
}
?>
    </section>
    <!--end middle container-->
    <script src="JS/trips.js">
    </script>
  </body>
</html>
