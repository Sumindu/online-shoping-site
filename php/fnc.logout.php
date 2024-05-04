<?php
session_start();
include_once 'db_conn.php';

if (isset($_SESSION['a_id'])) {
    session_unset();
    session_destroy();
    header("Location: ../adminlogin.php");
    exit();
} else {
    mysqli_query($conn, "DELETE FROM cart");
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}