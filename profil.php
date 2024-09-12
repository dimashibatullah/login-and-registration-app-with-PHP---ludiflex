<?php


require "util/functions.php";

session_start();

// cek apakah ada session
if (!isset($_SESSION['username'])) {
  // jika tidak ada
  header("Location: login.php");
  exit();
}


$dataUser = mysqli_query($conn, "SELECT * FROM loginregistrationludiflex WHERE username = '".$_SESSION['username']."' ");

if (mysqli_num_rows($dataUser) === 1) {
  $row = mysqli_fetch_assoc($dataUser);
  
}


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>profil</title>
    <link rel="stylesheet" href="css/profil.css" />
  </head>
  <body>
    <!-- header start -->
    <header class="header">
      <h1 class="brand">Logo</h1>
      <nav class="nav">
        <a href="changeProfil.php">Change Profile</a>
        <a href="logout.php"><h3 class="logOut-btn">Log Out</h3></a>
        
      </nav>
    </header>
    <!-- header end -->

    <!-- section start -->
    <section class="container">
      <div class="profil1">
        <h3 class="nama">Hello <span><?= $row['username']; ?></span>, Welcome</h3>
        <h3 class="email">Your email is <span><?= $row['email']; ?></span></h3>
      </div>
      <div class="profil2">
        <h3>and you are <span><?= $row['age'] ;?> years old</span></h3>
      </div>
    </section>
    <!-- section end -->
  </body>
</html>
