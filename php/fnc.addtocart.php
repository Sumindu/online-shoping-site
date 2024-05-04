<?php
include '../php/db_conn.php';

if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if we have a result
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            // Check if the product already exists in the cart
            $stmt2 = $conn->prepare("SELECT * FROM cart WHERE product_id = ?");
            $stmt2->bind_param("i", $product_id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($result2->num_rows > 0) {
                // Product already exists in the cart, update the quantity
                $stmt3 = $conn->prepare("UPDATE cart SET product_qnt = product_qnt + 1 WHERE product_id = ?");
                $stmt3->bind_param("i", $product_id);
                $stmt3->execute();
            } else {
                // Product does not exist in the cart, insert a new row
                $stmt4 = $conn->prepare("INSERT INTO cart (product_id, product_name, product_price, product_qnt) VALUES (?, ?, ?, 1)");
                $stmt4->bind_param("iss", $product_id, $row['name'], $row['price']);
                $stmt4->execute();
            }
        }
        
        // Redirect to cart.php
        header("Location: ../main/cart.php?success=Item Added successfully");
        exit();
    }
}
?>
