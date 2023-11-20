<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Pass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;300;400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/img/soccer-ground.ico">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login">
    <div class="">
        <div class="">           
<?php

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$mysqli = require __DIR__ . "/database.php";

$sql = "UPDATE user
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($mysqli->affected_rows) {

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("zona-futsal@gmail.com", "zona-futsal");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="http://localhost:3000/reset-password.php?token=$token">here</a> 
    to reset your password.

    END;

    try {
        $mail->send();
        echo '<div class="alert alert-success text-center" role="alert">Message sent, please check your inbox.</div>';
    } catch (Exception $e) {
        echo '<div class="alert alert-danger text-center" role="alert">Message could not be sent. Mailer error: {$mail->ErrorInfo}</div>';
    }
    

}
?>
        </div>
    </div>
</body>
</html>