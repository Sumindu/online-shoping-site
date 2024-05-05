<link rel="stylesheet" href="../style/add.user.css">
<?php

include "../php/db_conn.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $des = $row['des'];
        $price = $row['price'];
        $imgurl = $row['imgurl'];
    } else {
        echo "User not found.";
        exit();
    }
}

if (isset($_POST['name']) && isset($_POST['des']) && isset($_POST['price']) && isset($_FILES['image']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $des = $_POST['des'];
    $price = $_POST['price'];
    $imgurl = $_FILES['image']['name'];
    $imgtmp = $_FILES['image']['tmp_name'];

    // Get the old image URL
    $sql_old_img = "SELECT imgurl FROM products WHERE id = '$id'";
    $result_old_img = mysqli_query($conn, $sql_old_img);
    if ($row_old_img = mysqli_fetch_assoc($result_old_img)) {
        $old_img_url = $row_old_img['imgurl'];
        // Delete the old image file
        unlink("../img/$old_img_url");
    }

    // Move the uploaded image to the img folder
    move_uploaded_file($imgtmp, "../img/$imgurl");

    // Prepare and execute the SQL query
    $sql = "UPDATE products SET name = '$name', des = '$des', price = '$price', imgurl = '$imgurl' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: products.php?success=User details updated successfully");
        exit();
    } else {
        header("Location: edit.product.php?error=Database error");
        exit();
    }
}


?>
<div class="form">
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="title">Edit Products Details</div>
        <div class="subtitle">Edit Products Details Using Admin Dashboard</div>
        <?php if (isset($_GET['error'])): ?>
            <p class="error subtitle"><?= $_GET['error'] ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <p class="success subtitle"><?= $_GET['success'] ?></p>
        <?php endif; ?>
        <div class="input-container ic1">
            <div>
                <input name="name" class="input" type="text" placeholder=" " value="<?= $name ?>" />
                <div class="cut"></div>
                <label for="name" class="placeholder">Name</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="des" class="input" type="text" placeholder=" " value="<?= $des ?>"/>
                <div class="cut"></div>
                <label for="description" class="placeholder">Description</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="price" class="input" type="text" placeholder=" " value="<?= $price ?>"/>
                <div class="cut cut-short"></div>
                <label for="price" class="placeholder">Price(USD)</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="image" id="file-upload" accept=".jpg, .jpeg, .png" class="input" type="file" placeholder=" " />
                <div class="cut cut-short"></div>
                <label for="image" class="placeholder">Image</label>

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
