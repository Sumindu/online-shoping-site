<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style/loginStyle.css">
</head>
<body>
    <div class="wrapper">
    <form action="php/fnc.signup.php" method="post">
            <h1>Sign Up</h1>
            <!-- alerts -->
            <?php if(isset($_GET['error'])) {?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if(isset($_GET['success'])) {?>
            <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <div class="input-box">
                <input type="text" name="name" placeholder="Name" >
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" name="email" placeholder="Email" 
                required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" name="pass" placeholder="Password" 
                required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="input-box">
                <input type="password" name="r_pass" placeholder="Re-type Password" 
                required>
                <i class='bx bxs-lock'></i>
            </div>
            <!-- <div class="remember-forget">
                <label><input type="checkbox">I have agree Terms and Conditions</label>
            </div> -->
            <button type="submit" class="btn">Sign up</button>

            <div class="register-link">
                <p>Have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>