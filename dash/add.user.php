<link rel="stylesheet" href="../style/add.user.css">
<div class="form">
    <form action="../php/fnc.adduser.php" method="post">
        <div class="title">Add New User</div>
        <div class="subtitle">Add New User Using Admin Dashboard</div>
        <?php if(isset($_GET['error'])): ?>
            <p class="error subtitle"><?= $_GET['error'] ?></p>
        <?php endif; ?>
        <?php if(isset($_GET['success'])): ?>
            <p class="success subtitle"><?= $_GET['success'] ?></p>
        <?php endif; ?>
        <div class="input-container ic1">
            <div>
                <input name="name" class="input" type="text" placeholder=" " />
                <div class="cut"></div>
                <label for="name" class="placeholder">Name</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="email" class="input" type="text" placeholder=" " />
                <div class="cut"></div>
                <label for="email" class="placeholder">Email</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="pass" class="input" type="text" placeholder=" " />
                <div class="cut cut-short"></div>
                <label for="pass" class="placeholder">Password</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="r_pass" class="input" type="text" placeholder=" " />
                <div class="cut cut-short"></div>
                <label for="r_pass" class="placeholder">Re-type Password</label>
            </div>
        </div>
        <div>
            <button type="submit" class="submit">Submit</button>
        </div>
    </form>
<div>
    <button class="back" onclick="window.location.href = 'users.php';">Back</button>
</div>
</div>