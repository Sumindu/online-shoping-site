<?php

include "db_conn.php";

if (isset($_GET['delete'])) {
    
    $delete = $_GET['delete'];
    
    // Prepare and execute the SQL query
    $sql = "DELETE FROM users WHERE id = '$delete'";
    
    if(mysqli_query($conn,$sql)) {
        echo '<script> location.replace("../dash/users.php?error=Deletion successful")</script>'; 
        exit();
    } else{
        header("Location: ../dash/users.php?error=Database error");
        exit();
    }
        
}
