<?php
session_start();
error_reporting(0);
include '../Connection/connection.php';
$id = $_GET['id'];
if ($id == 0) {
  header('location: ../Home/');
} else {
  $sql = "select * from users where id='$id'";
  $qu = mysqli_query($con, $sql);
  $f = mysqli_fetch_assoc($qu);
  $re =   $f['password'];
  $pre = $f['image'];

  if (isset($_POST['update'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];


    if ($_FILES['img']['name']) {
      unlink("./assets/images" . $pre);
      move_uploaded_file($_FILES['img']['tmp_name'], "./assets/images/" . $_FILES['img']['name']);
      $img = "/" . $_FILES['img']['name'];
    } else {
      $img = $_POST['img1'];
    }

    $sql4 = "UPDATE users SET email='$email', fname='$fname', lname='$lname',telephone='$telephone', image='$img' WHERE id='$id'";

    mysqli_query($con, $sql4);
    $msg =  "Sucessfully updated";
  } else if (isset($_POST['Change'])) {
    $new     = $_POST['npassword'];
    $confirm = $_POST['cpassword'];
    $current = $_POST['password'];

    $hash = md5($current);
    $hasnew = md5($new);

    if ($re != $hash) {
      $error = "Current Password is wrong";
    } elseif ($new != $confirm) {
      $error = "Passwords are Mis match";
    } else {
      $sql3 = "UPDATE users SET password='$hasnew' WHERE id='$id'";
      mysqli_query($con, $sql3);
      $msg = "Sucesssfully updated";
    }
  }
}

?>
<!-- 
<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>


    <form method="post" enctype="multipart/form-data">

        <label id="name">First Name</label>
        <input id="name" type="text" name="fname" value="<?php echo $f['fname'] ?>" placeholder="Restuarant Name">

        
        <label id="name">Last Name</label>
        <input id="name" type="text" name="lname" value="<?php echo $f['lname'] ?>" placeholder="Restuarant Name">

        <label id="email">Email</label>
        <input id="email" type="email" name="email" placeholder="Email" value="<?php echo $f['email'] ?>">

        <label id="telephone">Telephone</label>
        <input id="telephone" type="tel" name="telephone" placeholder="telephone" maxlength="10" value="<?php echo $f['telephone'] ?>">

            <label id="image">Image</label>
        <img src="./assets/images<?php echo $f['image'] ?>" width="100px" height="100px" alt="">
        <input type="hidden" name="img1" value="<?php echo $f['image'] ?>">
        <input id="image" type="file" name="img" placeholder="file" >
        <input type="submit" name="update" value="Update">




    </form>
    <form method="POST">

        <label id="password">Change Password</label>
        <input id="password" type="password" name="password" placeholder="Current Password">
        <input id="password" type="password" name="npassword" placeholder="New Password">
        <input id="password" type="password" name="cpassword" placeholder="Confirm Password">
        <input type="submit" name="Change" value="Change">
    </form>


</body>

</html> -->

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

  <link rel="stylesheet" type="text/css" href="../Home/assets/css/font-awesome.css">

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
            <!-- ***** Logo Start ***** -->
            <a href="index.html" class="logo">EAt<em>.LK</em></a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="../Home/" class="active">Home</a></li>
              <li><a href="../Shop/allRestuarants.php">Shops</a></li>
              <li><a href="../Shop/viewpromotions.php">Promotions</a></li>
              <li><a href="../Home/about.php">About Us</a></li>
              <li><a href="../Home/contact.php">Contact us</a></li>



              <li class="dropdown">


                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">My Profile</a>

                <div class="dropdown-menu">

                  <a class="dropdown-item" href="../Customer/editdetails.php">Edit Details</a>
                  <a class="dropdown-item" href="../Customer/order.php">Order Details</a>
                  <a class="dropdown-item" href="../Home/logout.php">Log Out</a>
                </div>
              </li>

            </ul>
            <a class="menu-trigger">
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <section class="section section-bg" id="call-to-action" style="background-image: url(../Home/assets/images/banner-image-1-1920x500.jpg)">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="cta-content">
            <br />
            <br />
            <h2>Customer <em>Profile</em></h2>

          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <!-- ***** Header Area End ***** -->

    <div class="details">
      <li id="tname">Welcome back <?php echo $f['fname'] . ' ' . $f['lname'] ?></li>

      <img id="pic" src="../Customer/assets/images/<?php echo $f['image'] ?>">
      <ul id="details">
        <li>Name : <?php echo $f['fname'] . ' ' . $f['lname'] ?></li>
        <li>Email Address : <?php echo $f['email'] ?></li>
        <li>Contact Details :<?php echo $f['telephone'] ?> </li>


      </ul>



    </div>





    <section class="section">
      <div class="container">
        <br>
        <br>
        <div class="row">
          <div class="col-md-8">
            <div class="contact-form">
              <?php if ($error) { ?> <div class="alert alert-danger"><strong></strong><?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="alert success"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>

              <form id="" method="post" enctype="multipart/form-data">
                <div class="row">

                  <div class="col-md-6 col-sm-12">
                    <fieldset>
                      <input id="name" type="text" name="fname" value="<?php echo $f['fname'] ?>" placeholder="Name">
                    </fieldset>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <fieldset>
                      <input id="name" type="text" name="lname" value="<?php echo $f['lname'] ?>" placeholder="Last Name">
                    </fieldset>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <fieldset>
                      <input name="email" type="text" id="email" placeholder="E mail*" value="<?php echo $f['email'] ?>">
                    </fieldset>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <fieldset>
                      <input id="telephone" type="tel" name="telephone" placeholder="telephone" maxlength="10" value="<?php echo $f['telephone'] ?>">
                    </fieldset>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <fieldset>
                      <input type="hidden" name="img1" value="<?php echo $f['image'] ?>">
                      <input id="image" type="file" name="img" placeholder="file">
                    </fieldset>
                  </div>

                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="main-button" name="update">Update</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>

            <br>
          </div>

          <div class="col-md-4">
            <div class="tabs-content">
              <div class="contact-form">
                <form id="contact" action="" method="post">
                  <div class="row">

                    <div class="col-md-12 col-sm-12">
                      <fieldset>
                        <input id="password" type="password" name="password" placeholder="Current Password">
                      </fieldset>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <fieldset>
                        <input id="password" type="password" name="npassword" placeholder="New Password">
                      </fieldset>
                    </div>


                    <div class="col-md-12 col-sm-12">
                      <fieldset>
                        <input id="password" type="password" name="cpassword" placeholder="Confirm New Password">
                      </fieldset>
                    </div>


                    <div class="col-lg-12">
                      <fieldset>
                        <button type="submit" id="form-submit" name="Change" class="main-button">CHange</button>
                      </fieldset>
                    </div>
                  </div>
                </form>
              </div>

              <br>
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