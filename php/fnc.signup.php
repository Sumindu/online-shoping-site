<?php
include "db_conn.php";

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['r_pass'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $pass = validate($_POST['pass']);
    $r_pass = validate($_POST['r_pass']);

    if (empty($name) || empty($email) || empty($pass) || empty($r_pass)) {
        header("Location: ../signup.php?error=All fields are required");
        exit();
    } elseif ($pass !== $r_pass) {
        header("Location: ../signup.php?error=Passwords do not match");
        exit();
    } else {
        // Hash the password
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        // Prepare and execute the SQL query
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $name, $email, $hashedPass);
            $result = $stmt->execute();

            if ($result) {
                header("Location: ../login.php?success=Your account has been created successfully.Please Log in.");
                exit();
            } else {
                header("Location: ../signup.php?error=Database error");
                exit();
            }
        } else {
            header("Location: ../signup.php?error=SQL statement preparation failed");
            exit();
        }
    }
} else {
    header("Location: ../signup.php?error=error");
    exit();
}
