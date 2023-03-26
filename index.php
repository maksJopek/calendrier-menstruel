<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Chart</title>

  <script src="scripts/edit-data.js" defer></script>
</head>
<?php
require "php/get-data.php";
require "php/generate-img-map.php";
[$FX_DATA, $Y_DATA] = getChartData(true);
$X_DATA = [];
foreach ($FX_DATA as $xd) {
  array_push($X_DATA, $xd['data']);
}
$g = "";
foreach ($_GET as $k => $v) {
  $g .= "$k=$v&";
}
?>

<body bgcolor="black" style="color: white;">
  <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: fit-content; height: fit-content; background-color: #13ffde; text-align: center; display: none;">
    <input type="text" pattern="[\d\.]*" placeholder="Temperature (\d*\.\d*)" oninput="input()"><br><br>
    <button type="button" onclick="menuClick('save')">Save temperature</button><br><br>
    <button type="button" onclick="menuClick('condition')">Condition</button><br><br>
    <button type="button" onclick="menuClick('null')">No measurement</button><br><br>
    <button type="button" onclick="menuClick('cancel')">Cancel</button><br><br>
    <div style="color: black"></div>
  </div>
  <img src="php/generate-chart.php?<?php echo $g; ?>" alt="Chart" usemap="#chart" style="user-select: none;" draggable="false">
  <map id="chart" name="chart">
    <?= gen_img_map() ?>
  </map>
  <span style="display: none;">
    <?= json_encode($Y_DATA) ?>
  </span><br><br>
  <a href="php/gen-pdf.php" style="font-size: 20px; color: white">PDF</a>
</body>

</html>
