<link rel="stylesheet" href="../style/add.user.css">
<?php
include "../php/db_conn.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM orders WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $product_id = $row['product_id'];
        $product_qnt = $row['product_qnt'];
        $name = $row['name'];
        $address = $row['address'];
    } else {
        echo "Order not found.";
        exit();
    }
}

if (isset($_POST['product_id']) && isset($_POST['product_qnt']) && isset($_POST['name']) && isset($_POST['address']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $product_id = $_POST['product_id'];
    $product_qnt = $_POST['product_qnt'];
    $name = $_POST['name'];
    $address = $_POST['address'];

    // Prepare and execute the SQL query
    $sql = "UPDATE orders SET product_id = '$product_id', product_qnt = '$product_qnt', name = '$name', address = '$address' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: orders.php?success=Order details updated successfully");
        exit();
    } else {
        header("Location: orders.php?error=Database error");
        exit();
    }
}
?>

<div class="form">
    <form action="#" method="post">
        <div class="title">Edit User's Order</div>
        <div class="subtitle">Edit User's Order Using Admin Dashboard</div>
        <?php if (isset($_GET['error'])): ?>
            <p class="error subtitle"><?= $_GET['error'] ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <p class="success subtitle"><?= $_GET['success'] ?></p>
        <?php endif; ?>
        <div class="input-container ic1">
            <div>
                <input name="product_id" class="input" type="text" placeholder=" " value="<?= isset($product_id) ? $product_id : '' ?>" readonly />
                <div class="cut"></div>
                <label for="product_id" class="placeholder">Product ID</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="product_qnt" class="input" type="text" placeholder=" " value="<?= isset($product_qnt) ? $product_qnt : '' ?>" />
                <div class="cut"></div>
                <label for="product_qnt" class="placeholder">Product Quantity</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="name" class="input" type="text" placeholder=" " value="<?= isset($name) ? $name : '' ?>" />
                <div class="cut"></div>
                <label for="name" class="placeholder">Name</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="address" class="input" type="text" placeholder=" " value="<?= isset($address) ? $address : '' ?>" />
                <div class="cut"></div>
                <label for="address" class="placeholder">Address</label>
            </div>
        </div>
        <div>
            <button type="submit" class="submit">Submit</button>
        </div>
    </form>
    <div>
        <button class="back" onclick="window.history.back();">Back</button>
    </div>
</div>
