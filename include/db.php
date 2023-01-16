<?php

// Local database
$host = 'localhost';
$username= 'root';
$password= '';
$dbname= 'test_prupadi_public_db';
$charset= 'utf8mb4';


$dbstmt = "mysql:host=$host;dbname=$dbname;charset=$charset" ;

try {
    $conn = new PDO($dbstmt,$username,$password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    throw new PDO($e -> getMessage());
}

require_once 'crud.php';
?>