<link rel="stylesheet" href="../style/add.user.css">
<?php

include "../php/db_conn.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $email = $row['email'];
        $pass = $row['password'];
    } else {
        echo "User not found.";
        exit();
    }
}

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query
    $sql = "UPDATE users SET name = '$name', email = '$email', password = '$hashedPassword' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: users.php?success=User details updated successfully");
        exit();
    } else {
        header("Location: users.php?error=Database error");
        exit();
    }
}

?>
<div class="form">
    <form action="#" method="post">
        <div class="title">Edit User Details</div>
        <div class="subtitle">Edit User Details Using Admin Dashboard</div>
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
                <input name="email" class="input" type="text" placeholder=" " value="<?= $email ?>" />
                <div class="cut"></div>
                <label for="email" class="placeholder">Email</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="password" class="input" type="password" placeholder=" " />
                <div class="cut cut-short"></div>
                <label for="password" class="placeholder">Make New Password (Old Password Not Shown)</label>
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
