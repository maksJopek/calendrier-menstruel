<?php
function toPl(string $str): string
{
  return mb_convert_encoding($str, 'ISO-8859-2', 'UTF-8');
}
function nullOrData(array $array, int|string $key, mixed $default = NULL): mixed
{
  if (array_key_exists($key, $array)) {
    return $array[$key];
  }
  return $default;
}

