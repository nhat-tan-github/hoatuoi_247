<?php
require "inc/init.php";
require "dialog.php";
$conn = require("inc/db.php");
 

$query = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_id DESC";
$stmt = $db->getConn()->prepare($query);
$stmt->execute([$_SESSION['user_id']]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($orders);
?>
