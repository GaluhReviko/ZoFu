<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Verifikasi Email</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;300;400;700&display=swap" rel="stylesheet">
  <link rel="icon" href="/img/soccer-ground.ico">
  <link rel="stylesheet" href="style.css">
</head>

<body class="verify">
  <div class="center">
    <h1>Verifikasi Email</h1>
    <form method="POST" action="send-password-reset.php">
      <div class="txt_field">
        <input type="email" name="email" required>
        <span></span>
        <label>Email</label>
      </div>
      <button class="button btn-inti" name="Verify" id="verify">Verifikasi</button>
      <div class="verify_link">
        Kembali menuju <a href="login.php">Login</a> atau <a href="reset-password.php">Reset password</a>
      </div>
    </form>
  </div>
</body>

</html>