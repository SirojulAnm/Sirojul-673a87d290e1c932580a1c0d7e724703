<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "soaltest";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username= '".$_GET['username']."' AND password= '".$_GET['password']."'  ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Hello <?php echo $row['username']."<br>"; ?></h1>
    <p>You Are Login on <?php echo $row['time_login']."<br>"; ?></p>
</body>
</html>