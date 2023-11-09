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

<body class="reset">
  <div class="center">
    <h1>Reset</h1>
    <form method="POST">
      <div class="txt_field">
        <input type="password" name="password"  required>
        <span></span>
        <label>New Password</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" required>
        <span></span>
        <label>Confirm Password</label>
      </div>
      <button class="button btn-inti" name="reset" id="reset">Reset</button>
      <div class="reset_link">
        Kembali ke halaman <a href="login.php">Login</a>
      </div>
    </form>
  </div>

</body>

</html>