<?php

include "db_conn.php";

if (isset($_GET['delete'])) {
    
    $delete = $_GET['delete'];
    
    // Prepare and execute the SQL query
    $sql = "DELETE FROM feedback WHERE id = '$delete'";
    
    if(mysqli_query($conn,$sql)) {
        echo '<script> location.replace("../dash/feedback.php?error=Deletion successful")</script>'; 
        exit();
    } else{
        header("Location: ../dash/feedback.php?error=Database error");
        exit();
    }
        
}
