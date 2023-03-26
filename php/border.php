<?php

function drawBorder(GdImage $img): void
{
  global $X_DATA, $Y_DATA;
  require "consts.php";

  # Bg
  imagefilledrectangle($img, 0, 0, $WIDTH, $HEIGHT, $COLOR->white);

  # Border
  imageline($img, $LINES->hor->x1, $LINES->hor->y, $LINES->hor->x2, $LINES->hor->y, $COLOR->black);
  imageline($img, $LINES->ver->x, $LINES->ver->y1, $LINES->ver->x, $LINES->ver->y2, $COLOR->black);

  # Lines to make border cross in left bottom corner
  imageline($img, $LINES->ver->x - 5, $LINES->hor->y, $LINES->ver->x, $LINES->hor->y, $COLOR->black);
  imageline($img, $LINES->ver->x, $LINES->hor->y, $LINES->ver->x, $LINES->hor->y + 5, $COLOR->black);

  # Border strings
  $strX = (($LINES->hor->x1 + $LINES->hor->x2) / 2) - 40;
  $strY = $LINES->hor->y + 35;
  imagestring($img, $FONT, $strX, $strY, toPl("Dzień miesiąca"), $COLOR->black);
  $strX = $LINES->ver->x - 60;
  $strY = (($LINES->ver->y1 + $LINES->ver->y2) / 2) + 45;
  imagestringup($img, $FONT, $strX, $strY, toPl("Temperatura"), $COLOR->black);
  // imageline($img, 75, $HEIGHT - 75, $WIDTH - 75, $HEIGHT - 75, $COLOR->white);
  // imageline($img, 75, 50, 75, $HEIGHT - 75, $COLOR->white);
}

function drawGrid(GdImage $img): void
{
  global $X_DATA, $Y_DATA;
  require "consts.php";

  # Transverse line to border
  for ($x = $HOR_SPACE + $LINES->hor->x1; $x <= $LINES->hor->x2 + 1; $x += $HOR_SPACE) {
    imageline($img, $x, $LINES->hor->y - 10, $x, $LINES->hor->y + 10, $COLOR->black);
  }
  for ($y = $LINES->ver->y2 - $VER_SPACE; $y >= $LINES->ver->y1 - 1; $y -= $VER_SPACE) {
    imageline($img, $LINES->ver->x - 10, $y, $LINES->ver->x + 10, $y, $COLOR->black);
  }

  # Lines after border
  imageline($img, $LINES->hor->x2, $LINES->hor->y, $LINES->hor->x2 + $HOR_SPACE, $LINES->hor->y, $COLOR->black);
  imageline($img, $LINES->ver->x, $LINES->ver->y1, $LINES->ver->x, $LINES->ver->y1 - 5, $COLOR->black);

  # Dashed grid
  for ($x = $HOR_SPACE + $LINES->hor->x1, $c = 1; $x <= $LINES->hor->x2 + 1; $x += $HOR_SPACE, $c++) {
    imagesetstyle($img, $ARR);
    imageline($img, $x, $LINES->hor->y, $x, $LINES->ver->y1 - 5, IMG_COLOR_STYLED);
    /* imagedashedline($img, $x, $LINES->hor->y, $x, $LINES->ver->y1 - 5, $COLOR->grey); */
    imagestring($img, $FONT, $x - ($FONT / 3) * strlen($c) - 1.5, $LINES->hor->y + 15, $c, $COLOR->black);
  }
  for ($y = $LINES->ver->y2 - $VER_SPACE, $i = 0; $y >= $LINES->ver->y1 - 1; $y -= $VER_SPACE, $i++) {
    if ($i === $TEMP_NUM - 2)
      imageline($img, $LINES->ver->x + 10, $y, $LINES->hor->x2 + $HOR_SPACE, $y, $COLOR->red);
    else {
      imagesetstyle($img, $ARR);
      imageline($img, $LINES->ver->x, $y, $LINES->hor->x2 + $HOR_SPACE, $y, IMG_COLOR_STYLED);
      /* imagedashedline($img, $LINES->ver->x, $y, $LINES->hor->x2 + $HOR_SPACE, $y, $COLOR->grey); */
    }

    if ($i === 0)
      $str = $Y_DATA[$i];
    else
      $str = $Y_DATA[$i] === floor($Y_DATA[$i]) ? $Y_DATA[$i] . ".0" : substr($Y_DATA[$i] - floor($Y_DATA[$i]), 1);

    /* imagestring($img, $FONT - 2, $LINES->ver->x - 30 - ($FONT * abs(strlen($str) - 2)), $y - ($FONT / 2) * strlen($i + 1) - 5, $str, $COLOR->black); */
    imagestring($img, $FONT - 2, $LINES->ver->x - 30 - (($FONT + 2) * abs(strlen($str) - 2)), $y - ($FONT / 2) * strlen($i + 1) - 5, $str, $COLOR->black);
  }
}
