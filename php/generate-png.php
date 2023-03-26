<?php
function genPng()
{
  require "get-data.php";
  /* header('Content-Type: image/png'); */

  [$X_DATA, $Y_DATA] = getChartData();
  require "helpers.php";
  require "consts.php";
  require "border.php";
  require "chart.php";

  drawBorder($IMG);
  drawGrid($IMG);
  drawChart($IMG);

  return imagepng($IMG);
  /* imagedestroy($IMG); */
}
