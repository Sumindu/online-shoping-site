<?php
include "db_conn.php";
session_start();

if (isset($_POST['email']) && isset($_POST['pass'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['pass']);

    if (empty($email)) {
        header("Location: ../login.php?error=username is required");
        exit();
    } else if(empty($pass)) {
        header("Location: ../login.php?error=password is required");
        exit();
    } else {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM users WHERE email = ?";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['password'])) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: ../main/shop.php?success=Your Log in successful");
                exit();
            } else {
                header("Location: ../login.php?error=Incorrect Username or Password");
                exit();
            }
        } else {
            header("Location: ../login.php?error=Incorrect Username or Password");
            exit();
        }
    }

} else {
    header("Location: ../login.php?error=ERROR");
    exit();
}