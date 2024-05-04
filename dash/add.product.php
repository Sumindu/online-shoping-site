<link rel="stylesheet" href="../style/add.user.css">
<div class="form">
    <form action="../php/fnc.addproduct.php" method="post" enctype="multipart/form-data">
        <div class="title">Add New Product</div>
        <div class="subtitle">Add New Product Using Admin Dashboard</div>
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
                <input name="des" class="input" type="text" placeholder=" " />
                <div class="cut"></div>
                <label for="description" class="placeholder">Description</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="price" class="input" type="text" placeholder=" " />
                <div class="cut cut-short"></div>
                <label for="price" class="placeholder">Price(USD)</label>
            </div>
        </div>
        <div class="input-container ic2">
            <div>
                <input name="imgurl" id="file-upload" accept=".jpg, .jpeg, .png" class="input" type="file" placeholder=" " />
                <div class="cut cut-short"></div>
                <label for="image" class="placeholder">Image</label>
            </div>
        </div>
        <div>
            <button type="submit" class="submit">Submit</button>
        </div>
    </form>
<div>
    <button class="back" onclick="window.location.href = 'products.php';">Back</button>
</div>
</div>