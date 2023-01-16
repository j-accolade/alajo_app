<?php
require_once 'include/db.php';
$pagename = 'add customer';
require_once 'include/header.php';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];

    $customers = new Customers($conn);
    $inserted = $customers -> insert($username);
    if ($inserted) {
        header('Location: dashboard.php?msg=Created_Customer');
    }
}
?>
<div class="containe-fluid">
    <div class="container my-5">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="mb-3">
                <input min="100" name="username" placeholder="Enter your username" type="text" class="form-control" id="username" aria-describedby="username" required>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">Add Customer</button>
        </form>
    </div>
</div>