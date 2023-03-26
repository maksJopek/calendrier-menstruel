<?php
$WIDTH = nullOrData($_GET, 'w', 1600);
$HEIGHT = nullOrData($_GET, 'h', 600);
$IMG = imagecreatetruecolor($WIDTH, $HEIGHT);

$COLOR = new stdClass();
$COLOR->white = imagecolorallocate($IMG, 255, 255, 255);
$COLOR->red = imagecolorallocate($IMG, 255, 0, 0);
$COLOR->blue = imagecolorallocate($IMG, 0, 0, 255);
$COLOR->grey = imagecolorallocate($IMG, 100, 100, 100);
$COLOR->black = imagecolorallocate($IMG, 0, 0, 0);

$LINES = new stdClass();
$LINES->hor = new stdClass();
$LINES->hor->x1 = nullOrData($_GET, 'x1m', 0.1) * $WIDTH;
$LINES->hor->x2 = nullOrData($_GET, 'x2m', 0.9) * $WIDTH;
$LINES->ver = new stdClass();
$LINES->ver->y1 = nullOrData($_GET, 'y1m', 0.15) * $HEIGHT;
$LINES->ver->y2 = nullOrData($_GET, 'y2m', 0.75) * $HEIGHT;

$LINES->ver->x = $LINES->hor->x1;
$LINES->hor->y = $LINES->ver->y2;

$DAY_NUM = count($X_DATA);
$TEMP_NUM = count($Y_DATA);

$HOR_SPACE = abs($LINES->hor->x1 - $LINES->hor->x2) / $DAY_NUM;
$VER_SPACE = abs($LINES->ver->y1 - $LINES->ver->y2) / $TEMP_NUM;

$FONT = 5;
$ARR = [$COLOR->white, $COLOR->white, $COLOR->grey, $COLOR->grey];

/* $Y_DATA = [36.2, 36.4, 36.6, 36.8, 37.0, 37.2]; */
/* $X_DATA = [36.4, 36.35, 36.3, 36.35, 36.4, 36.39, 36.4, 36.28, 36.4, 36.34, 36.33, 36.35, 36.21, 36.71, 37.00, 36.61, 36.71, 36.77, 36.8, 36.78, -1, 36.82, -1, 36.78, NULL, 36.82, 36.58, 36.41]; */
/* $X_DATA = [36.0, 36.2, 36.3, 36.4, 36.5, 36.6, 36.7, 36.8, 36.9, 37.0, 37.1, 37.2, 36.35, 36.21, 36.71, 37.00, 36.61, 36.71, 36.77, 36.8, 36.78, -1, 36.82, -1, 36.78, NULL, 36.82, 36.58, 36.41]; */
/* $X_DATA = [36.4, 36.35, 36.28, 36.3, 36.4, 36.39, 36.4, 36.27, 36.4, 36.33, 36.21, 36.71, 37.0, 36.61, 36.62, 36.78, 36.6, 36.78, 36.79, 36.7, 37.0, -1, NULL, 36.61, 36.63, 36.7, -1, -1]; */
