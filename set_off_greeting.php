<?php 
session_start();
$_SESSION['greeting'] = 0;

echo json_encode($_SESSION);
?>