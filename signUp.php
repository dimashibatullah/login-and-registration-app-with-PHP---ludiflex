<?php

require "util/functions.php";

$registrationSuccess = false;

// cek isi $_POST
if (isset($_POST["submit"])) {
  
  if (registrasi($_POST) > 0) {
    $registrationSuccess = true;
  
  } else {
  };
};



?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>sign up</title>
    <link rel="stylesheet" href="css/signUp.css" />
  </head>
  <body>
    <div class="container">
      <h2>Sign Up</h2>
      <form id="form" action="" method="post">
        <ul>
          <li>
            <label for="username">Username</label> <br />
            <input type="text" id="username" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : ''; ?>" required/>
            <span><?= isset($error["usernameLen"]) ? $error["usernameLen"] : ''?></span>
            <span><?= isset($error["invalidUsername"]) ? $error["invalidUsername"] : ''?></span>
            <span><?= isset($error["sameUsername"]) ? $error["sameUsername"] : ''?></span>
          </li>
          <li>
            <label for="email">Email</label> <br />
            <input type="email" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" required/>
            <span><?= isset($error["emailFormat"]) ? $error["emailFormat"] : ''?></span>
            
            </li>
            <li>
            <label for="age">Age</label> <br />
            <input type="number" id="age" name="age" value="<?= isset($_POST['age']) ? $_POST['age'] : ''; ?>" required/>
            <span><?= isset($error["rangeAge"]) ? $error["rangeAge"] : ''?></span>
            </li>
            <li>
            <label for="password">Password</label> <br />
            <input type="password" id="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>" required />
            <span><?= isset($error["passFormat"]) ? $error["passFormat"] : ''?></span>
          </li>
          <li>
            <button type="submit" name="submit" id="reg-btn">Register</button>
          </li>
        </ul>
      </form>
      <div id="message-reg">
        <p>Registration Successfully!</p>
      </div>
      <a href="login.php" id="redirect-login">Login now!</a>
    </div>
    <script src="util/signUp.js"></script>
    <script>
      const regSuccess = <?php echo json_encode($registrationSuccess)?>
    </script>
    <script src="util/signUp.js"></script>
    <script>
      if (regSuccess) {
        registrationSuccess()
      }
    </script>


   
  </body>
</html>
