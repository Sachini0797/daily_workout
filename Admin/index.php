<?php
session_start();
error_reporting(0);
include '../Connection/connection.php';
$id = $_SESSION['id'];
$sql = "SELECT COUNT(0)
  FROM users where usertype='Customer';";
$result = (mysqli_query($con, $sql));
$data = mysqli_fetch_assoc($result);


$rest = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(0)
  FROM shops;"));

$foods = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(0)
    FROM products;"));

$inq = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(0)
    FROM inquiries;"));

// if ($id == 0) {
//   header('location: ../login/login.php');
// } 

?>

<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> X-TEAM-Admin Dashboard </title>
  <link rel="stylesheet" href="style.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class=''></i>
      <span class="logo_name">X-TEAM</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="./index.php" class="active">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="./users.php">
          <i class='bx bx-user'></i>
          <span class="links_name"> Users</span>
        </a>
      </li>
      <li>
        <a href="./restuarants.php">
          <i class='bx bx-restaurant'></i>
          <span class="links_name">Shops</span>
        </a>
      </li>
      <li>
        <a href="./promotions.php">
          <i class='bx bx-pie-chart-alt-2'></i>
          <span class="links_name">Promotions</span>
        </a>
      </li>
      <li>
        <a href="./inquiries.php">
          <i class='bx bx-book-alt'></i>
          <span class="links_name">Inquiries</span>
        </a>
      </li>

      <li>
        <a href="../Home/">
          <i class='bx bx-cog'></i>
          <span class="links_name">Web Site</span>
        </a>
      </li>
      <li class="log_out">
        <a href="../Home/logout.php">
          <i class='bx bx-log-out'></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>

      <div class="profile-details">
        <i class='bx bxs-user-rectangle'></i>
        <span class="admin_name">Admin</span>

    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Users</div>
            <div class="number"><?php echo $data['COUNT(0)']  ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up to now</span>
            </div>
          </div>
          <i class='bx bxs-user-pin cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Shops</div>
            <div class="number"><?php echo $rest['COUNT(0)']  ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up to now</span>
            </div>
          </div>
          <i class='bx bx-restaurant cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Menus</div>
            <div class="number"><?php echo $foods['COUNT(0)']  ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up to now</span>
            </div>
          </div>
          <i class='bx bx-food-menu cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Inquiries</div>
            <div class="number"><?php echo $inq['COUNT(0)'] ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt '></i>
              <span class="text">Up to now</span>
            </div>
          </div>
          <i class='bx bxs-conversation cart'></i>
        </div>
      </div>


      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title"></div>
          <div class="sales-details">
            <img src="../Home/assets/images/about-fullscreen-1-1920x700.jpg" width="100%" alt="">
          </div>
        </div>
      </div>
    </div>

  </section>

  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
  </script>

</body>

</html>