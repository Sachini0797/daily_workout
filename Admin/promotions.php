<?php
session_start();
error_reporting(0);
include '../Connection/connection.php';

$id = $_SESSION['id'];
$sql = "SELECT * FROM promotions order by  promocode asc;";
$res = mysqli_query($con, $sql);



if ($id == 0) {
  header('location: ../login/login.php');
} else {
  $accptid = $_GET['promocode'];
  $type   = $_GET['type'];

  $pic = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM promotions WHERE promocode='$accptid'"));
  $picture = $pic['image'];


  if ($type == 'accept') {
    $accept = "UPDATE promotions SET status=1 WHERE promocode='$accptid'";
    mysqli_query($con, $accept);
    echo "<script type='text/javascript'> document.location = './promotions.php'; </script>";
  } elseif ($type == 'reject') {
    $reject = "DELETE FROM promotions  WHERE promocode='$accptid'";
    unlink("../Restuarant/assets1/promotions/" . $picture);
    mysqli_query($con, $reject);
    echo "<script type='text/javascript'> document.location = './promotions.php'; </script>";
  }
}


?>

<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">

<head>

  <meta charset="UTF-8">
  <title> X-TEAM-Admin Dashboard </title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="./assets/style.css">

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
        <a href="./index.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="./users.php">
          <i class='bx bx-user'></i>
          <span class="links_name">Users</span>
        </a>
      </li>
      <li>
        <a href="./restuarants.php">
          <i class='bx bx-restaurant'></i>
          <span class="links_name">Restuarants</span>
        </a>
      </li>
      <li>
        <a href="./promotions.php" class="active">
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
    <div class="home-content1">
      <h2>Promotions Management </h2>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Restuarant Name</th>
            <th scope="col">Promotion name</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>

            <th scope="col">date</th>
            <th scope="col">action</th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            // $i=1;
            while ($row = mysqli_fetch_assoc($res)) { ?>
              <td><?php echo $row['promocode'] ?></td>

              <td><?php echo $row['restname'] ?></td>
              <td><?php echo $row['promoname'] ?></td>

              <td><?php echo $row['description'] ?></td>
              <td><img src="../Restuarant/assets1/promotions/<?php echo $row['image'] ?>" alt="promo"> </td>

              <td><?php echo $row['date'] ?></td>

              <td><?php if ($row['status'] == 1) {
                    echo "<a href='./promotions.php?type=reject&promocode=" . $row['promocode'] . "'><button type='button' class='btn btn-danger'>Delete</button></a>";
                  } else {
                    echo "<a href='./promotions.php?type=accept&promocode=" . $row['promocode'] . "'><button type='button' class='btn btn-success'>Accept</button></a>";
                    echo "<a href='./promotions.php?type=reject&promocode=" . $row['promocode'] . "'><button type='button' class='btn btn-danger'>Reject</button></a>";
                  }
                  ?>

              </td>
          </tr>
        <?php
            } ?>
        <tr>

        </tbody>
      </table>
      <!-- <table>
               <thead>
                   <tr>
                       <th>Name</th>
                       <th>email</th>
                       <th>telphone</th>
                       <th>date</th>
                       <th>action</th>
                   </tr>
                   <TD>THARINDU</TD>
                   <td>tharinu413</td>
                   <td>0775398171</td>
                   <td>2021/112/12</td>
                   <td>delete and disable</td>
               </thead>
           </table> -->


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