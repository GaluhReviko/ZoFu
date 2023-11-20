<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;300;400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/img/soccer-ground.ico">
    <link rel="stylesheet" href="style.css">
</head>

<body class="login">
    <div class="">
        <div class="">
            <?php

            $token = $_POST["token"];

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
                echo '<div class="alert alert-danger text-center" role="alert">Token not found</div>';
                die();
            }

            if (strtotime($user["reset_token_expires_at"]) <= time()) {
                echo '<div class="alert alert-danger text-center" role="alert">Token has expired</div>';
                die();
            }

            // if (strlen($_POST["password"]) < 8) {
            //     die("Password must be at least 8 characters");
            // }

            // if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
            //     die("Password must contain at least one letter");
            // }

            // if ( ! preg_match("/[0-9]/", $_POST["password"])) {
            //     die("Password must contain at least one number");
            // }

            if ($_POST["password"] !== $_POST["password_confirmation"]) {
                echo '<div class="alert alert-danger text-center" role="alert">Passwords must match</div>';
                die();
            }

            $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $sql = "UPDATE user
        SET password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id_user = ?";

            $stmt = $mysqli->prepare($sql);

            $stmt->bind_param("ss", $password_hash, $user["id_user"]);

            $stmt->execute();

            echo '<div class="alert alert-success text-center" role="alert">Password updated. You can now login.</div>';
            header("Location: login.php");
            exit();
            ?>
        </div>
    </div>

</body>

</html>