<?php
function drawChart(GdImage $img): void
{
  global $X_DATA, $Y_DATA;
  require "consts.php";

  $xx = [];
  for ($x = $HOR_SPACE + $LINES->hor->x1; $x <= $LINES->hor->x2 + 1; $x += $HOR_SPACE) {
    array_push($xx, $x);
  }
  $yy = [];
  for ($y = $LINES->ver->y2 - $VER_SPACE; $y >= $LINES->ver->y1 - 1; $y -= $VER_SPACE) {
    array_push($yy, $y);
  }

  $i = 0;
  $ox = -1;
  $oy = -1;
  foreach ($X_DATA as $xd) {
    $x = $xx[$i];

    if ($xd === NULL) {
      imagefilledellipse($img, $x, $yy[0] + $VER_SPACE, 7, 7, $COLOR->grey);
      $ox = -1;
      $oy = -1;
    } elseif ($xd < 0) {
      imagefilledellipse($img, $x, $yy[0] + $VER_SPACE, 7, 7, $COLOR->red);
      $ox = -1;
      $oy = -1;
    } else {
      $close_to = (($xd * 10 - $Y_DATA[0] * 10) / 10) / (($Y_DATA[1] * 10 - $Y_DATA[0] * 10) / 10) * $VER_SPACE;

      $y = ($yy[0] * 10 - $close_to * 10) / 10;

      imagefilledellipse($img, $x, $y, 7, 7, $COLOR->blue);

      if ($ox >= 0)
        imageline($img, $ox, $oy, $x, $y, $COLOR->blue);

      $ox = $x;
      $oy = $y;
    }

    $i++;
  }
}
