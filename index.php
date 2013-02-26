<?php
require 'nested.php';
require 'convert.php';

$list = array(
  1 => 'one',
  2 => 'two',
  3 => array(
    31 => 'thirty-one',
    32 => 'thirty-two'
  ),
  4 => 'four',
  5 => 'five',
  6 => array(
    61 => 'sixty-one',
    62 => array(
      621 => 'six hundred and twenty-one',
      622 => 'six hundred and twenty-two',
      623 => array(
        6231 => 'six thousand two hundred and thirty-one',
        6233 => array(
          62331 => 'sixty-two thousand three hundred and thirty-one'
        )
      )
    )
  ),
  7 => 'seven'
);

  $nested = new Nested();
  $convert = new Convert();

  echo "<h2>First Quetion :</h2>";
  echo $nested->show_tree($list);

  echo "<h2>Second Quetion :</h2>";
  echo $nested->sum_key($list);

  echo "<h2>Third Quetion :</h2>";

  echo $convert->number_to_words(621) . "<br />";
  echo $convert->number_to_words(62331) . "<br />";
  echo $convert->number_to_words(6233113) . "<br />";
  echo $convert->number_to_words(3.14159) . "<br />";
  echo $convert->number_to_words(-3.1) . "<br />";
  echo $convert->number_to_words(2147483646) . "<br />";