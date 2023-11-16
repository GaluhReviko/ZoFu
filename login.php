<?php
session_start();
require "functions.php";


if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];
  if ($role == "Admin") {
    header("Location: admin/home.php");
  } else {
    header("Location: index.php");
  }
}

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $cariadmin = query("SELECT * FROM admin WHERE email = '$username' AND password = '$password'");
  $cariuser = query("SELECT * FROM user WHERE email = '$username'");

  if ($cariadmin) {
    // set session
    $_SESSION['username'] = $cariadmin[0]['nama'];
    $_SESSION['role'] = "Admin";
    header("Location: admin/admin.php");
  } else if ($cariuser) {
    // set session
    password_verify($password, $cariuser[0]['password']);
    $_SESSION['email'] = $cariuser[0]['email'];
    $_SESSION['id_user'] = $cariuser[0]['id_user'];
    $_SESSION['role'] = "User";
    header("Location: index.php");
  } else {
    echo "<div class='alert alert-warning'>Username atau Password salah</div>
    <meta http-equiv='refresh' content='2'>";
  }
}


?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login Zona Futsal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;300;400;700&display=swap" rel="stylesheet">
  <link rel="icon" href="/img/soccer-ground.ico">
  <link rel="stylesheet" href="style.css">
</head>

<body class="login">
  <div class="center">
    <h1>Login</h1>
    <form method="POST">
      <div class="txt_field">
        <input type="email" name="username" required>
        <span></span>
        <label>Email</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" required>
        <span></span>
        <label>Password</label>
      </div>
      <div class="reset_link"><a href="verifikasi.php">Lupa Password?</a></div>
      <button class="button btn-inti" name="login" id="login">Login</button>
      <div class="signup_link">
        Belum Punya Akun? <a href="user/daftar.php">Daftar</a>
      </div>
    </form>
  </div>

</body>

</html>
