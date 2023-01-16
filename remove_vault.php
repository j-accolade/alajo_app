<?php
require_once 'include/db.php';
require_once 'include/session.php';

$vaults = new Vaults($conn);
if (isset($_GET['vault'])) {
    $vid = $_GET['vault'];
    $vaults -> delete($vid);
    header('Location: dashboard.php?msg='.$vid.'_deleted');
} else {
    header('Location: dashboard.php?msg=user_not_set');
}

?>