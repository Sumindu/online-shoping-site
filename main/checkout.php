<link rel="stylesheet" href="../style/add.user.css">
<?php
include '../php/db_conn.php';

$sql = "SELECT * FROM cart";
$result = mysqli_query($conn, $sql);
$totalBalance = 0; // Initialize total balance variable
$totalQuantity = 0; // Initialize total quantity variable

while ($row = mysqli_fetch_assoc($result)) {
    $subtotal = $row['product_price'] * $row['product_qnt']; // Calculate subtotal for each product
    $totalBalance += $subtotal; // Add subtotal to total balance
    $totalQuantity += $row['product_qnt']; // Add quantity to total quantity
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are set
    if (isset($_POST['uname'], $_POST['uaddress'])) {
        $uname = $_POST['uname'];
        $uaddress = $_POST['uaddress'];

        // Insert each item from cart into orders table
        $sql = "INSERT INTO orders (product_id, product_qnt, name, address) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $result = mysqli_query($conn, "SELECT * FROM cart");
        while ($row = mysqli_fetch_assoc($result)) {
            $stmt->bind_param("iiss", $row['product_id'], $row['product_qnt'], $uname, $uaddress);
            $stmt->execute();
        }

        // Clear cart after placing order
        mysqli_query($conn, "DELETE FROM cart");

        header("Location: cart.php?success=Order Placed successfully");
        exit();
    } else {
        header("Location: checkout.php?error=Missing required fields");
        exit();
    }
}
?>
<div class="form">
    <form action="#" method="post">
        <div class="title">Checkout Page</div>
        <div class="subtitle">All Items in the Cart </div>
        <div class="subtitle">Total Quantity: <?= $totalQuantity ?></div> <!-- Display total quantity -->
        <div class="subtitle">Your Total Balance is: $ <?= $totalBalance ?></div> <!-- Display total balance -->
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
