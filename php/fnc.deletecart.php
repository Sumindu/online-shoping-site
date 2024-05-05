<?php

include "db_conn.php";

if (isset($_GET['delete'])) {
    
    $delete = $_GET['delete'];
    
    // Prepare and execute the SQL query
    $sql = "DELETE FROM cart WHERE id = '$delete'";
    
    if(mysqli_query($conn,$sql)) {
        echo '<script> location.replace("../main/cart.php?error=Deletion successful")</script>'; 
        exit();
    } else{
        header("Location: ../main/cart.php?error=Database error");
        exit();
    }
        
}
