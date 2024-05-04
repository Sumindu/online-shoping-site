<link rel="stylesheet" href="../style/add.user.css">
<?php

include "../php/db_conn.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM cart WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $product_price = $row['product_price'];
        $product_qnt = $row['product_qnt'];
    } else {
        echo "Product not found.";
        exit();
    }
}

if (isset($_POST['qnt']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $qnt = $_POST['qnt'];

    // Prepare and execute the SQL query
    $sql = "UPDATE cart SET product_qnt = '$qnt' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: cart.php?success=Cart details updated successfully");
        exit();
    } else {
        header("Location: edit.cart.php?error=Database error");
        exit();
    }
}

?>
<div class="form">
    <form action="#" method="post">
        <div class="title">Edit Cart Details</div>
        <div class="subtitle">Edit Cart Details Using Admin Dashboard</div>
        <?php if (isset($_GET['error'])): ?>
            <p class="error subtitle"><?= $_GET['error'] ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <p class="success subtitle"><?= $_GET['success'] ?></p>
        <?php endif; ?>
        <div class="input-container ic1">
            <div>
                <input name="name" class="input" type="text" placeholder=" " value="<?= $product_name ?>" readonly />
                <div class="cut"></div>
                <label for="name" class="placeholder">Product Name</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="price" class="input" type="text" placeholder=" " value="<?= $product_price ?>" readonly />
                <div class="cut cut-short"></div>
                <label for="price" class="placeholder">Price</label>
            </div>
        </div>
        <div>
        <div class="input-container ic2">
            <div>
                <input name="qnt" class="input" type="text" placeholder=" " value="<?= $product_qnt ?>" />
                <div class="cut"></div>
                <label for="qnt" class="placeholder">Quantity</label>
            </div>
        </div>
            <button type="submit" class="submit">Submit</button>
        </div>
    </form>
    <div>
        <button class="back" onclick="window.history.back();">Back</button>
    </div>
</div>
