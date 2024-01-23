<?php
    include 'koneksi.php';
    session_start();
    if (isset($_POST['login'])) {
        $username = $_POST['username'] ;
        $password = $_POST['password'] ;
        if ($username!="" && $password!="") {
             $query = mysqli_query($koneksi, "select * from admin where username='$username' and password='$password'");
            if ($data = mysqli_fetch_array($query)) {
                $_SESSION['username']= $data['username'];
                $_SESSION['password']= $data['password'];
                header('location: admin.php');
            } else {
                
            }
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
        <form action="loginadmin.php" method="post">
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