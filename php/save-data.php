<?php
$new_data = json_decode(file_get_contents("php://input"), true);
$user = 'clientApps';
$pass = 'clientApps';
$db = 'ClientApps';
$out = [];

$pdo = new PDO("mysql:dbname=$db;host=localhost;charset=utf8mb4", $user, $pass);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$stmt = $pdo->prepare("UPDATE chart_x SET data = :data WHERE id = :id");
$stmt->execute($new_data);
