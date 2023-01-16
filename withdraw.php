<?php
require_once 'include/session.php';
if (isset($_POST['submit'])) {
    require_once 'include/auth_check.php';
    $wamount = $_POST['cangive'];
    $vault_id = $_POST['v_id'];
    echo $wamount;
    echo $vault_id;
}else {
    header("Location: dashboard.php");
}
?>