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
     <?php
$error_message = "";
$success_message = "";

// Register user
if(isset($_POST['btnsignup'])){
   $fname = trim($_POST['fname']); //sterge spatii din stanga si din dreapta
   $lname = trim($_POST['lname']);
   $email = trim($_POST['email']);
   $password = trim($_POST['password']);
   $confirmpassword = trim($_POST['confirmpassword']);

   $isValid = true;

   // Check fields are empty or not
   if($fname == '' || $lname == '' || $email == '' || $password == '' || $confirmpassword == ''){
     $isValid = false;
     $error_message = "Please fill all fields.";
   }

   // Check if confirm password matching or not
   if($isValid && ($password != $confirmpassword)){
     $isValid = false;
     $error_message = "Confirm password not matching";
   }

   // Check if Email-ID is valid or not
   if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $isValid = false;
     $error_message = "Invalid Email-ID.";
   }

   if($isValid){

     // Check if Email-ID already exists
     $stmt = $conexiune->prepare("SELECT * FROM cont WHERE id_cont = ?");
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $result = $stmt->get_result();
     $stmt->close();
     if($result->num_rows > 0){
       $isValid = false;
       $error_message = "Email-ID is already existed.";
     }

   }

   // Insert records
   if($isValid){
     $insertSQL = "INSERT INTO cont (nume, prenume, email, parola) values(?,?,?,?)";
     $stmt = $conexiune->prepare($insertSQL);
     $password = md5($password);
     $stmt->bind_param("ssss", $fname, $lname, $email, $password);

     $stmt->execute();
     $stmt->close();

     $success_message = "Account created successfully.";
   }
}

?>

  </head>
  <body>
    <section class="top-container">
      <!-- Hamburger Menu -->
      <label for="toggle">
        <i class="fas fa-bars hamburger hide"></i>
      </label>
      <header>

        <nav class="menu main-navigation">
          <h2 id="title">Bus & Train Ticket Booking</h2>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="plan.php">Plan Your Trip</a></li>
            <li><a href="mybookings.php">Your Bookings</a></li>
            <button onclick="location.href='logare.php';" type="button" class="btn btn-primary" data-toggle=" " data-target="">
              Get Started
            </button>
          </ul>
        </nav>

        <!-- Small display Responsive Navigation begins -->
        <input type="checkbox" id="toggle" name="toggle">
        <nav class="navigation--responsive">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="plan.php">Plan Trips</a></li>
            <li> <a href="mybookings.php">Bookings</a></li>
            <button onclick="location.href='logare.php';" type="button" class="btn btn-primary" data-toggle=" " data-target="" style="margin-top: 15px;">
              <!-- am nevoie de margin-top pentru versiunea de mobil -->
              Get Started
            </button>
          </ul>
        </nav>
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

      </header>

    </section>
    <section class="middle-container">
      <div class='container'>
        <div class='row'>
          <div class='col-md-6' >
            <form method='post' action=''>
              <br>
              <h2>Register here
              </h2>
              <?php
  // Display Error message
  if(!empty($error_message)){
  ?>
              <div class="alert alert-danger">
                <strong>Error!
                </strong>
                <?= $error_message ?>
              </div>
              <?php
  }
  ?>
              <?php
  // Display Success message
  if(!empty($success_message)){
  ?>
              <div class="alert alert-success">
                <strong>Success!
                </strong>
                <?= $success_message ?>
              </div>
              <?php
  }
  ?>
              <div class="form-group">
                <label for="fname">First Name:
                </label>
                <input type="text" class="form-control" name="fname" id="fname" required="required" maxlength="80">
              </div>
              <div class="form-group">
                <label for="lname">Last Name:
                </label>
                <input type="text" class="form-control" name="lname" id="lname" required="required" maxlength="80">
              </div>
              <div class="form-group">
                <label for="email">Email address:
                </label>
                <input type="email" class="form-control" name="email" id="email" required="required" maxlength="80">
              </div>
              <div class="form-group">
                <label for="password">Password:
                </label>
              </button>

                <input type="password" class="form-control" name="password" id="password" required="required" maxlength="80">
              </div>
              <div class="form-group">
                <label for="pwd">Confirm Password:
                </label>
                <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" onkeyup='' required="required" maxlength="80">
              </div>
              <button type="submit" name="btnsignup" class="btn btn-primary">Submit
              </button>
              <br>
              <br>

            </form>
            <form  action="" method="post">
              <button type="submit" name="random" class="btn btn-primary">Generate Strong Password
                <?php if(isset($_POST['random'])) {
                  $result = mysqli_query($conexiune, "SELECT genereaza_parola() AS 'parola'"); //apel functia stocata mysql
                  $row = mysqli_fetch_assoc($result);
                  $To = $row['parola'];
                  echo "<script>alert('$To')</script>"; 
                } ?>

            </form>
            </div>
            <br>

            <div class ="col-md-6" >
              <br>
              <h2>Login here
              </h2>
              <form  class="form-group" action="validare.php" method="post">
                <label>Email:
                </label>
                <input type = "text" name="email" class="form-control" required="required"  />

                <label>Password:
                </label>
                <input type = "password" name="password" class="form-control" required="required"  /> <br>
              <input type ="submit" name="log" value ="Submit" class="btn btn-primary"/>
              <br> <br>
            </form>
          </div>

        </div>

    </section>



  </body>
</html>
