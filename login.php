<?php
session_start();
if(isset($_SESSION['id'])) {
    header("Location: main/shop.php"); // Redirect logged-in users to the dashboard
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style/loginStyle.css">
</head>
<body>
    <div class="wrapper">
        <form action="php/fnc.login.php" method="post">
            <h1>User Login</h1>
            <!-- alerts -->
            <?php if(isset($_GET['error'])) {?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if(isset($_GET['success'])) {?>
            <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
            <div class="input-box">
                <input type="text" name="email" placeholder="Email or Username" 
                required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="pass" placeholder="Password" 
                required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="remember-forget">
            </div>
            <button name="submit" type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </div>
            <div class="register-link">
                <p><a href="adminlogin.php">Log as a Admin</a></p>
            </div>
        </form>
    </div>
</body>
</html>