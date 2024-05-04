<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $imgurl = $_POST['imgurl'];
    $des = $_POST['des'];
    $price = $_POST['price'];

    if (empty($name) || empty($des) || empty($price)) {
        redirectWithErrorMessage("All fields are required");
    }

    if (!isset($_FILES['imgurl']) || $_FILES['imgurl']['error'] === 4) {
        redirectWithErrorMessage("Image does not exist");
    }

    $img_name = $_FILES['imgurl']['name'];
    $img_size = $_FILES['imgurl']['size'];
    $tmp_name = $_FILES['imgurl']['tmp_name'];

    $allowed_exs = ['jpg', 'jpeg', 'png'];
    $img_ex = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

    if (!in_array($img_ex, $allowed_exs)) {
        redirectWithErrorMessage("Invalid image extension");
    }

    $new_img_name = uniqid() . "." . $img_ex;
    $destination = '../img/' . $new_img_name;

    if (!move_uploaded_file($tmp_name, $destination)) {
        redirectWithErrorMessage("Failed to upload image");
    }

    // Insert into Database
    $sql = "INSERT INTO products (imgurl, name, des, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        redirectWithErrorMessage("SQL statement preparation failed");
    }

    $stmt->bind_param("ssss", $new_img_name, $name, $des, $price);
    $result = $stmt->execute();

    if ($result) {
        redirectWithSuccessMessage("Product added successfully");
    } else {
        redirectWithErrorMessage("Database error");
    }
} else {
    redirectWithErrorMessage("Invalid request");
}

function redirectWithErrorMessage($error)
{
    header("Location: ../dash/add.product.php?error=" . urlencode($error));
    exit();
}

function redirectWithSuccessMessage($message)
{
    header("Location: ../dash/add.product.php?success=" . urlencode($message));
    exit();
}
