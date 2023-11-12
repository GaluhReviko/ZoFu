<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM user
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;300;400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/img/soccer-ground.ico">
    <link rel="stylesheet" href="style.css">
</head>

<body class="reset">
    <div class="center">
        <h1>Reset Password</h1>
        <form method="post" action="process-reset-password.php">
            <div class="txt_field">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <input type="password" id="password" name="password" required>
                <span></span>
                <label for="password">New password</label>
            </div>
            <div class="txt_field">
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                <span></span>
                <label for="password_confirmation">Repeat password</label>
            </div>
            <button class="button btn-inti" name="reset" id="reset">Reset</button>
            <div class="reset_link">
                Kembali ke halaman <a href="login.php">Login</a>
            </div>
        </form>
    </div>
</body>

</html>