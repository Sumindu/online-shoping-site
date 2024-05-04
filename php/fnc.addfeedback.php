<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        redirectWithErrorMessage("All fields are required");
    }

    // Insert into Database
    $sql = "INSERT INTO feedback (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        redirectWithErrorMessage("SQL statement preparation failed");
    }

    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    $result = $stmt->execute();

    if ($result) {
        redirectWithSuccessMessage("Feedback sended successfully");
    } else {
        redirectWithErrorMessage("Database error");
    }
} else {
    redirectWithErrorMessage("Invalid request");
}

function redirectWithErrorMessage($error)
{
    header("Location: ../main/feedback.php?error=" . urlencode($error));
    exit();
}

function redirectWithSuccessMessage($message)
{
    header("Location: ../main/feedback.php?success=" . urlencode($message));
    exit();
}
?>
