<?php include 'head.dash.php';
include '../php/db_conn.php';
?>
<link rel="stylesheet" href="../style/add.user.css">

<div class="form">
    <form action="../php/fnc.addfeedback.php" method="post">
        <div class="title">User Feedback Form</div>
        <div class="subtitle">Users Can Directly Send Masseges to Admin</div>
        <!-- Alert msgs -->
<?php if(isset($_GET['error'])) {?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if(isset($_GET['success'])) {?>
            <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
            <!-- alerts msgs -->
        <div class="input-container ic1">
            <div>
                <input name="name" class="input" type="text" placeholder=" " />
                <div class="cut"></div>
                <label for="name" class="placeholder">Your Name</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="email" class="input" type="text" placeholder=" " />
                <div class="cut cut-short"></div>
                <label for="email" class="placeholder">Your Email</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="subject" class="input" type="text" placeholder=" " />
                <div class="cut cut-short"></div>
                <label for="subject" class="placeholder">Subject</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <textarea name="message" class="input" placeholder=" "></textarea>
                <div class="cut"></div>
                <label for="message" class="placeholder">Message</label>
            </div>
        </div>
            <button type="submit" class="submit">Submit</button>
        </div>
    </form>
</div>
<script src="../script/light.dash.js"></script>
