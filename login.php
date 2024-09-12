
<?php

require "util/functions.php";

session_start();



$errorLogin = [];

// cek isi $_POST
if (isset($_POST['submit-login'])) {
  
  // ambil data dari form
  $email = $_POST['email'];
  $password = $_POST['password'];

  // ambil data user dari database
  $dataUserDB = mysqli_query($conn, "SELECT * FROM loginregistrationludiflex WHERE email = '$email'"); 

  if (mysqli_num_rows($dataUserDB) === 1) { 
    // jika email ada
    $row = mysqli_fetch_assoc($dataUserDB);
    // cek password
    if (password_verify($password, $row['password'])) {
      //  jika password benar

      //simpan username pada session
      $_SESSION['username'] = $row['username'];

      // pindah ke halaman profil.php
      header("Location:profil.php");
    } else {
      $errorLogin['falsePass'] = "password anda salah";
    }
  } else {
    $errorLogin['emailNoRegistered'] = "email tidak terdaftar";

  }

}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <div class="container">
      <h2>Login</h2>
      <form id="form" action="" method="post">
      <ul>
        <li>
          <label for="email">Email</label> <br />
          <input type="email" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '';?>"/>
          <span><?= isset($errorLogin['emailNoRegistered']) ? $errorLogin['emailNoRegistered'] : '';?></span>
        </li>
        <li>
          <label for="password">Password</label> <br />
          <input type="password" id="password" name="password"  />
          <span><?= isset($errorLogin['falsePass']) ? $errorLogin['falsePass'] : '';?></span>

        </li>
        <li>
          <button type="submit" name="submit-login" id="login-btn">Login</button>
        </li>
      </ul>
      </form>
      <div class="link-signUp">
        <p>Don't have account? <a href="signUp.php">Sign Up now</a></p>
      </div>
    </div>
  </body>
</html>
