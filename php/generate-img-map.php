<?php
function gen_img_map(): string
{
  global $X_DATA, $Y_DATA, $FX_DATA;
  require "helpers.php";
  require "consts.php";

  $out = "";

  $xx = [];
  for ($x = $HOR_SPACE + $LINES->hor->x1; $x <= $LINES->hor->x2 + 1; $x += $HOR_SPACE) {
    array_push($xx, $x);
  }
  $yy = [];
  for ($y = $LINES->ver->y2 - $VER_SPACE; $y >= $LINES->ver->y1 - 1; $y -= $VER_SPACE) {
    array_push($yy, $y);
  }

  $i = 0;
  foreach ($X_DATA as $xd) {
    $x = $xx[$i];
    if ($xd === NULL) {
      $out .= "<area shape='circle' coords='$x," . $yy[0] + $VER_SPACE . ",4' onclick='showMenu(" . $FX_DATA[$i]['id'] . ", null)'>\n";
    } elseif ($xd < 0) {
      $out .= "<area shape='circle' coords='$x," . $yy[0] + $VER_SPACE . ",4' onclick='showMenu(" . $FX_DATA[$i]['id'] . ", $xd)'>\n";
    } else {
      $close_to = (($xd * 10 - $Y_DATA[0] * 10) / 10) / (($Y_DATA[1] * 10 - $Y_DATA[0] * 10) / 10) * $VER_SPACE;
      $y = ($yy[0] * 10 - $close_to * 10) / 10;
      $out .= "<area shape='circle' coords='$x,$y,4' onclick='showMenu(" . $FX_DATA[$i]['id'] . ", $xd)'>\n";
    }

    $i++;
  }

  return $out;
}
