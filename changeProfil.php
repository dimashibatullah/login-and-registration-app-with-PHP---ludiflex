<?php


require "util/functions.php";

session_start();

// cek apakah ada session
if (!isset($_SESSION['username'])) {
  // jika tidak ada
  header("Location: login.php");
  exit();
}

// ambil data dari database
$dataUser = mysqli_query($conn, "SELECT * FROM loginregistrationludiflex WHERE username = '".$_SESSION['username']."' ");
if (mysqli_num_rows($dataUser) === 1) {
  $row = mysqli_fetch_assoc($dataUser);
}



// cek submit form
if (isset($_POST['submit-update'])) {
    // jalankan fungsi update profil
    if (updateProfil($_POST, $row['id'], $_SESSION['username'])) {
      $_SESSION['flashMessage'] = "Profil updated success";
    } 
}
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>change profile</title>
    <link rel="stylesheet" href="css/changeProfil.css" />
  </head>
  <body>
    <div class="container">
        <h2>Change Profil</h2>
        <?php if(!isset($_SESSION['flashMessage'])) :?>
        <form id="form" action="" method="post">
            <ul>
            <li>
                <label for="username">Username</label> <br />
                <input type="username" id="username" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : $row['username'] ;?>" />
                <span><?= isset($error["usernameLen"]) ? $error["usernameLen"] : ''?></span>
                <span><?= isset($error["invalidUsername"]) ? $error["invalidUsername"] : ''?></span>
                <span><?= isset($error['sameUsername']) ? $error['sameUsername'] : '' ;?></span>
            </li>
            <li>
                <label for="email">Email</label> <br />
                <input type="email" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : $row['email'];?>" />
                <span><?= isset($error["emailFormat"]) ? $error["emailFormat"] : ''?></span>
            </li>
            <li>
                <label for="age">Age</label> <br />
                <input type="age" id="age" name="age" value="<?= isset($_POST['age']) ? $_POST['age'] : $row['age'];?>" />
                <span><?= isset($error["rangeAge"]) ? $error["rangeAge"] : ''?></span>
            </li>
            <li>
                <button type="submit" name="submit-update" id="update-btn">Update</button>
            </li>
            </ul>
        </form>
        <?php endif; ?>
        <?php if(isset($_SESSION['flashMessage'])) : ?>
        <div id="message-reg">
            <p><?= $_SESSION['flashMessage']; ?></p>
        </div>
        <?php unset($_SESSION['flashMessage']); // Hapus setelah ditampilkan ?>
        <a href="profil.php" id="redirect-profil">go home!</a>
        <?php endif; ?>
    </div>
  </body>
</html>
