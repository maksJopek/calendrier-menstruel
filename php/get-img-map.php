<?php
require "get-data.php";
require "generate-img-map.php";
[$FX_DATA, $Y_DATA] = getChartData(true);
$X_DATA = [];
foreach ($FX_DATA as $xd) {
  array_push($X_DATA, $xd['data']);
}

echo gen_img_map();
