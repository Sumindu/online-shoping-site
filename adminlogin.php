<?php
    session_start();
    if(isset($_SESSION['a_id'])) {
        header("Location: dash/users.php"); // Redirect logged-in users to the dashboard
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        include "php/db_conn.php";

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $email = validate($_POST['email']);
        $pass = validate($_POST['pass']);

        if (empty($email)) {
            $error = "Email is required";
        } else if(empty($pass)) {
            $error = "Password is required";
        } else {
            // Use prepared statements to prevent SQL injection
            $sql = "SELECT * FROM admin WHERE email = ?";

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($pass == $row['password']) { // Compare passwords directly
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['a_id'] = 1;
                    header("Location: dash/users.php?success=Your Log in successful");
                    exit();
                } else {
                    $error = "Incorrect Email or Password";
                }
            } else {
                $error = "Incorrect Email or Password";
            }
        }

        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style/loginStyle.css">
</head>
<body>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h1>Admin Login</h1>
            <!-- alerts -->
            <?php if(isset($error)) {?>
            <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <div class="input-box">
                <input type="text" name="email" placeholder="Username" 
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
                <p><a href="login.php">Log as a User</a></p>
            </div>
        </form>
    </div>
</body>
</html>