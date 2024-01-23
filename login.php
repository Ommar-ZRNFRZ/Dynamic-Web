<?php
    include 'koneksi.php';

    if (isset($_POST['login'])) {
        $username = $_POST['username'] ;
        $password = $_POST['password'] ;
        $query = mysqli_query($koneksi, "select * from user_data where username='$username' and password='$password'");
        if (mysqli_num_rows($query)>0) {
            header("location: index.php");
        } else {
            header("location: login.php");
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Uap</title>
</head>
<body>
    <div class="signup-box">
        <h1>Log in</h1>
        <form action="login.php" method="post">
            <label>Username</label>
            <input type="text" placeholder="Masukan Username" name="username" required>
            <label>Password</label>
            <input type="password" placeholder="Masukan Password" name="password" required>
            <input type="submit" name="login" value="Login">
        </form>
    </div>
    </div>
</body>
</html>