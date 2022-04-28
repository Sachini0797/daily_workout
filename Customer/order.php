<?php
session_start();
// error_reporting(0);
include '../Connection/connection.php';
$id = $_SESSION['id'];
if ($id == 0) {
  header('location: ../login/login.php');
} else {
  $sql = "select * from users where id='$id'";
  $qu = mysqli_query($con, $sql);
  $f = mysqli_fetch_assoc($qu);
  $number = $f['telephone'];

  $order = "SELECT * FROM orders WHERE  phone='$number' ";
  $result1 = (mysqli_query($con, $order));
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



  <title>Eatts.lk - </title>

  <link rel="stylesheet" type="text/css" href="../Home/assets/css/bootstrap.min.css">

  <!-- <link rel="stylesheet" type="text/css" href="../Home/assets/css/font-awesome.css"> -->
  <link rel="stylesheet" type="text/css" href="../Home/assets/css/font-awesome.css" />

  <link rel="stylesheet" href="../Home/assets/css/style.css">

</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->


  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ** Logo Start ** -->
            <a href="../Home/" class="logo">EAt <em> LK</em></a>
            <!-- ** Logo End ** -->
            <!-- ** Menu Start ** -->
            <ul class="nav">
              <li><a href="../Home/">Home</a></li>
              <li><a href="../Shop/allRestuarants.php" class="active">Shops</a></li>
              <li><a href="../Home/about.php">About Us</a></li>
              <li><a href="../Home/contact.php">Contact</a></li>
              <?php
              $sql1 = "SELECT * FROM users WHERE id='$id' ";
              $RES = mysqli_query($con, $sql1);
              $result = mysqli_fetch_assoc($RES);
              if ($result['usertype'] != 'Customer') {
              ?>
                <li>
                  <a href="../home/">
                    <button type="button" class="btn btn-outline-danger">
                      Sign up
                    </button></a>
                </li>
                <li>
                  <a href="../login/login.php">
                    <button type="button" class="btn btn-outline-success">
                      Log In
                    </button></a>
                </li>
              <?php } else { ?>
                <li class="dropdown">


                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">My Profile</a>

                  <div class="dropdown-menu">

                    <a class="dropdown-item" href="../Customer/editdetails.php">Edit Details</a>
                    <a class="dropdown-item" href="../Customer/order.php">Order Details</a>
                    <a class="dropdown-item" href="../Home/logout.php">Log Out</a>
                  </div>
                </li>
              <?php } ?>
            </ul>
            <a class="menu-trigger">
              <span>Menu</span>
            </a>
            <!-- ** Menu End ** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <section class="section section-bg" id="call-to-action" style="background-image: url(../Home/assets/images/banner-image-1-1920x500.jpg)">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="cta-content">
            <br />
            <br />
            <h2>Have a look at <em>Your Orders</em></h2>

          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <section class="section">
      <div class="container">
        <br />
        <br />
        <div class="row">
          <div class="col-md-12">
            <h2>Orders</h2>
            <br />
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Order Code</th>
                  <th scope="col">Items</th>
                  <th scope="col">Date</th>
                  <th scope="col">Amount</th>
                  <!-- <th scope="col">Action</th> -->
                </tr>
              </thead>
              <?php
              while ($order1 = mysqli_fetch_assoc($result1)) { ?>
                <tbody>
                  <tr>
                    <th scope="row"><?php echo $order1['id']  ?></th>
                    <td><?php echo $order1['products']  ?></td>
                    <td><?php echo $order1['date']  ?></td>
                    <td>$<?php echo $order1['amount_paid']  ?></td>

                  </tr>
                <?php } ?>

                </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>







    <!-- ***** Footer Start ***** -->
    <div>
    <?php include('../Home/footer.php'); ?>
  </div>


    <!-- jQuery -->
    <script src="../Home/assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="../Home/assets/js/popper.js"></script>
    <script src="../Home/assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="../Home/assets/js/scrollreveal.min.js"></script>
    <script src="../Home/assets/js/waypoints.min.js"></script>
    <script src="../Home/assets/js/jquery.counterup.min.js"></script>
    <script src="../Home/assets/js/imgfix.min.js"></script>
    <script src="../Home/assets/js/mixitup.js"></script>
    <script src="../Home/assets/js/accordions.js"></script>

    <!-- Global Init -->
    <script src="../Home/assets/js/custom.js"></script>

</body>

</html>