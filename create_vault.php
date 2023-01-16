<?php
$pagename = 'add customer';
require_once 'include/header.php';
require_once 'include/db.php';

$users = new Customers($conn);
$allUsers = $users -> selectAll();

if (isset($_POST['submit'])) {
    $user_id = $_POST['user'];
    $principal = $_POST['principal'];
    $paid = $_POST['paid'];
    $count = $paid/$principal;

    $vaults = new Vaults($conn);
    $created = $vaults -> insert($user_id, $principal, $count);
    if ($created) {
        header('Location: dashboard.php?msg=created');
    } else {
        header('Location: dashboard.php?msg=Uncreated');
    }

}
?>

<div class="container my-5">
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
    <div class="mb-3">
        <select name="user" class="form-select" aria-label="Select Customer" required>
            <option value="">Select a Customer</option>
            <?php foreach ($allUsers as $user) { ?>
                <option value="<?php echo $user['customer_id']?>"><?php echo $user['username']?></option>
            <?php }?>
        </select>
    </div>
    <div class="mb-3">
        <input min="100" name="principal" placeholder="Daily amount" type="number" class="form-control" id="principal" aria-describedby="principal_amount" required>
    </div>
    <div class="mb-3">
        <input min="100" name="paid" placeholder="How much are you paying now" type="number" class="form-control" id="paid" aria-describedby="amount_paid" required>
    </div>
    <button name="submit" type="submit" class="btn btn-primary">Create Vault</button>
    </form> 
</div>
