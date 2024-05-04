<link rel="stylesheet" href="../style/add.user.css">
<?php
include "../php/db_conn.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM feedback WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $email = $row['email'];
        $subject = $row['subject'];
        $message = $row['message'];
    } else {
        echo "Feedback not found.";
        exit();
    }
}

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Prepare and execute the SQL querys
    $sql = "UPDATE feedback SET name = '$name', email = '$email', subject = '$subject', message = '$message' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: feedback.php?success=Feedback details updated successfully");
        exit();
    } else {
        header("Location: feedback.php?error=Database error");
        exit();
    }
}
?>

<div class="form">
    <form action="#" method="post">
        <div class="title">Edit User FeedBack</div>
        <div class="subtitle">Edit User FeedBack Using Admin Dashboard</div>
        <?php if (isset($_GET['error'])): ?>
            <p class="error subtitle"><?= $_GET['error'] ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <p class="success subtitle"><?= $_GET['success'] ?></p>
        <?php endif; ?>
        <div class="input-container ic1">
            <div>
                <input name="name" class="input" type="text" placeholder=" " value="<?= isset($name) ? $name : '' ?>" />
                <div class="cut"></div>
                <label for="name" class="placeholder">Name</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="email" class="input" type="text" placeholder=" " value="<?= isset($email) ? $email : '' ?>" />
                <div class="cut"></div>
                <label for="email" class="placeholder">Email</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="subject" class="input" type="text" placeholder=" " value="<?= isset($subject) ? $subject : '' ?>" />
                <div class="cut"></div>
                <label for="subject" class="placeholder">Subject</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="message" class="input" type="text" placeholder=" " value="<?= isset($message) ? $message : '' ?>" />
                <div class="cut"></div>
                <label for="message" class="placeholder">Message</label>
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
