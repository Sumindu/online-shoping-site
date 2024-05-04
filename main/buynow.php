<link rel="stylesheet" href="../style/add.user.css">
<?php

require_once "../php/db_conn.php";

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the SQL query to fetch product details
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If product found, fetch its details
    if ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
    } else {
        echo "Product not found.";
        exit();
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are set
    if (isset($_POST['uname'], $_POST['uaddress'], $_GET['id'])) {
        $id = $_GET['id'];
        $uname = $_POST['uname'];
        $uaddress = $_POST['uaddress'];
        $product_qnt = 1; // Set product quantity to 1

        // Prepare and execute the SQL query to insert order
        $stmt = $conn->prepare("INSERT INTO orders (product_id, product_qnt, name, address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $id, $product_qnt, $uname, $uaddress);
        if ($stmt->execute()) {
            header("Location: shop.php?success=Order Placed successfully");
            exit();
        } else {
            header("Location: buynow.php?error=Database error");
            exit();
        }
    } else {
        echo "Missing required fields.";
        exit();
    }
}

?>
<div class="form">
    <form action="#" method="post">
        <div class="title">Checkout Page</div>
        <div class="subtitle">You choose the <?= $name ?> product.</div> <!-- Display product name -->
        <div class="subtitle">Price: $ <?= $price ?></div> <!-- Display product price -->
        <?php if (isset($_GET['error'])): ?>
            <p class="error subtitle"><?= $_GET['error'] ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <p class="success subtitle"><?= $_GET['success'] ?></p>
        <?php endif; ?>
        <div class="input-container ic1">
            <div>
                <input name="uname" class="input" type="text" placeholder=" " required />
                <div class="cut"></div>
                <label for="uname" class="placeholder">Your Name</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="uaddress" class="input" type="text" placeholder=" " required />
                <div class="cut"></div>
                <label for="uaddress" class="placeholder">Address</label>
            </div>
        </div>
        <div>
            <button type="submit" class="submit">Place an Order</button>
        </div>
    </form>
    <div>
        <button class="back" onclick="window.history.back();">Back</button>
    </div>
</div>
