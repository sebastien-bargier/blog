<?php

session_start();

require '../common/config.php'; 

$id = $_GET['id'];

$req = $db->query("DELETE FROM `categories` WHERE id = $id");

header('location: admin.php');

?>