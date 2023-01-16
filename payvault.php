<?php
require_once 'include/session.php';
require_once 'include/auth_check.php';
require_once 'include/db.php';
$vaults = new Vaults($conn);
// Condition to check if form was submitted
if (isset($_POST['submit'])) {

    $principal = $_POST['principal'];
    $amount = $_POST['samount'];
    $count = (floatval($amount) / floatval($principal));
    $roundcount = round($count,2);
    $vault_id = $_POST['vault_id'];
    $dbdays = $_POST['dbdays'];
    $newdbdays = $dbdays + $roundcount;

    $qryresult = $vaults -> payIntoVault($newdbdays, $vault_id);
    if ($qryresult) {
        header("Location: dashboard.php?msg=successful");   
    }
}else {
    header("Location: dashboard.php?msg=Failed");
}

?>