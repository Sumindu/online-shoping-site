<?php
session_start();
if(isset($_SESSION['id'])) {
    header("Location: main/shop.php"); // Redirect logged-in users to the dashboard
    exit();
}
else{
    header("Location: login.php");
    exit();
}
?>