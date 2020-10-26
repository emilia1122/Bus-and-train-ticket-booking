    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
      <meta charset="utf-8">
      <title>Admin</title>
      <link rel="stylesheet" href="css/admin.css">
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    </head>

    <body>
      <div class="wrapper">

    <nav>

      <header>
        <i class="far fa-user" style="margin-left: 30px; margin-right: 10px;"></i>
        <span></span>
        Admin
        <a></a>
      </header>
    </nav>

    <main>

      <h1>Admin</h1>
      <form class="admin" action="" method="post">

        <select class="chosen-select" name="options">
          <option  value="">
          </option>
          <option  value="train">Train
          </option>
          <option  value="users">Users
          </option>
        </select>
        <input type="submit" name="submit" value="Search" class="btn btn-primary btn-sm" style="margin-left: 14px; margin-bottom: 6px;">

    </form>


      <div class="flex-grid">
          <?php


  require 'mysql.php';
  if(isset($_POST['submit']) && isset($_POST['options'])) {
  $option = $_POST['options'];
  if ($option == 'train') {
    echo '<form  class="table-responsive ">
        <table class="table" style="width: 97%;">
          <thead style="background: #007bff">
            <tr style="color: #fff;">
              <th scope="col">From
              </th>
              <th scope="col">To
              </th>
              <th scope="col">Departure
              </th>
              <th scope="col">Arrival
              </th>
              <th scope="col">Price
              </th>
              <th scope="col">Duration
              </th>
              <th scope="col">Day
              </th>
              <th scope="col">Name
              </th>
              <th scope="col">Id Train
              </th>
              <th scope="col">Id Route
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">
              </th>';


  $sql = "SELECT * FROM v_pct_f";
  $rezultat = mysqli_query($conexiune, $sql);
  if (mysqli_num_rows($rezultat) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($rezultat)) {
  echo "<tr>";
  echo "<td>" .$row['origine'] . "</td>";
  echo "<td>" . $row["destinatie"] . "</td>";
  echo "<td>" . $row["plecare"] . "</td>";
  echo "<td>" . $row["sosire"] . "</td>";
  echo "<td>" . $row["pret"] . "</td>";
  echo "<td>" . $row["durata"] . "</td>";
  echo "<td>" . $row["ziua"] . "</td>";
  echo "<td>" . $row["nume"] . "</td>";
  echo "<td>" . $row["id_tren"] . "</td>";
  echo "<td>" .$row['id_ruta'] ."</td>";
  echo "</tr>";
  }
  }
  echo '</tr>
  </tr>
  </tbody>
  </table>';
} if($option == 'users') {
  echo '<form  class="table-responsive ">
      <table class="table" style="width: 97%;">
        <thead style="background: #007bff">
          <tr style="color: #fff;">
            <th scope="col">Contact Id
            </th>
            <th scope="col">Date
            </th>
            <th scope="col">Message
            </th>
            <th scope="col">User Id
            </th>
            <th scope="col">First Name
            </th>
            <th scope="col">Second Name
            </th>
            <th scope="col">Email
            </th>
            <th scope="col">Delete
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">
            </th>';


$sql = "SELECT * FROM v_pct_g";
$rezultat = mysqli_query($conexiune, $sql);
if (mysqli_num_rows($rezultat) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($rezultat)) {
echo "<tr>";
echo "<td>" .$row['id_contact'] . "</td>";
echo "<td>" . $row["data"] . "</td>";
echo "<td>" . $row["mesaj"] . "</td>";
echo "<td>" . $row["id_cont"] . "</td>";
echo "<td>" . $row["nume"] . "</td>";
echo "<td>" . $row["prenume"] . "</td>";
echo "<td>" . $row["email"] . "</td>";
echo "<td><a href='admin.php?id=".$row['id_contact']."'>Delete</a></td>";
echo "</tr>";
}
}
echo '</tr>
</tr>
</tbody>
</table>';
} if($_GET) {
$id_cont = $_GET['id'];
$id_contact = "SELECT id_contact, id_cont FROM contact WHERE id_cont = $id_cont LIMIT 1";
$rezultat = mysqli_query($conexiune, $id_contact);
$row = mysqli_fetch_assoc($rezultat);
$post_numbers = $row['id_contact'];
$delete = mysqli_query($conexiune,"CALL delete_utilizator_cu_mesaj('$id_cont', '$post_numbers')");
if($delete)
{
mysqli_close($conexiune);
header("location: admin.php", true);
}
else
{
echo "Error deleting record";
}
}
}

  ?>


  </div>

    </body>

    </html>
