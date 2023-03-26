<?php
function getChartData($getPK = false): array
{
  $user = 'clientApps';
  $pass = 'clientApps';
  $db = 'ClientApps';
  $out = [];

  $pdo = new PDO("mysql:dbname=$db;host=localhost;charset=utf8mb4", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  if ($getPK === true) {
    $stmt = $pdo->prepare("SELECT id, data FROM chart_x");
    $stmt->execute();
    $out[0] = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $stmt = $pdo->prepare("SELECT data FROM chart_x");
    $stmt->execute();
    $out[0] = $stmt->fetchAll(PDO::FETCH_COLUMN);
  }

  $stmt = $pdo->prepare("SELECT data FROM chart_y");
  $stmt->execute();
  $out[1] = $stmt->fetchAll(PDO::FETCH_COLUMN);

  return $out;
}
