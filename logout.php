<?php
include_once 'include/session.php';

session_destroy();
header('Location: index.php')
?>