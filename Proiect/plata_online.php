<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Plata
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
  </head>
  <body>
    <div class="padding">
      <div class="row">
        <div class="container-fluid d-flex justify-content-center">
          <div class="col-sm-8 col-md-6">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-6">
                    <span>CREDIT/DEBIT CARD PAYMENT
                    </span>
                  </div>
                  <div class="col-md-6 text-right" style="margin-top: -5px;">
                    <img src="https://img.icons8.com/color/36/000000/visa.png">
                    <img src="https://img.icons8.com/color/36/000000/mastercard.png">
                    <img src="https://img.icons8.com/color/36/000000/amex.png">
                  </div>
                </div>
              </div>
              <form  action="mybookings.php" method="post" class="card-body" style="height: 350px">
                <div class="form-group">
                  <label for="cc-number" class="control-label">CARD NUMBER
                  </label>
                  <input id="cc-number" name="cc" type="tel" class="input-lg form-control cc-number" autocomplete="cc-number" placeholder="••••••••••••••••" required>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cc-exp" class="control-label">CARD EXPIRY YEAR
                      </label>
                      <input id="cc-exp" name="cc-exp" type="tel" class="input-lg form-control cc-exp" autocomplete="cc-exp" placeholder="••••" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cc-cvc" class="control-label">CARD CVC
                      </label>
                      <input id="cc-cvc" type="tel" name= "cc-cvc"class="input-lg form-control cc-cvc" autocomplete="off" placeholder="•••" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="numeric" class="control-label">CARD HOLDER NAME
                  </label>
                  <input type="text" name="name" class="input-lg form-control">
                  <input type="hidden" name="hidden_price" value="<?php echo $_POST['hidden_price']; ?>">
                </div>
                <div class="form-group">
                  <input value="MAKE PAYMENT" type="submit" name="plata_efectuata" class="btn btn-success btn-lg form-control" style="font-size: .8rem;">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
session_start();
?>
    <?php
if(isset($_POST['continue'])) {
require 'mysql.php';
if(!isset($_SESSION['email'])) {
header('location: logare.php');
} if(isset($_SESSION['email'])) {
$date = $_SESSION["when"];
$date1 = date('Y-m-d',strtotime($date));
$call = "CALL preia_date_pentru_rezervare('$date1', '". $_SESSION['id']."', '". $_POST['id_tren']."', '1');";
if(mysqli_query($conexiune, $call)) {
echo '<script>alert("Final check!")</script>';
} else {
  echo "string";
} }
}
?>
  </body>
</html>
​
