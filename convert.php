<?php

class Convert{

  public function number_to_words($number)
  {

    $string = null;
    $fraction =  null;
    $hyphen  = " - ";
    $minus = "minus ";
    $and = ' and ';
    $separator = ", ";
    $decimal = " point ";

    $dictionary = array(
      0                   => 'zero',
      1                   => 'one',
      2                   => 'two',
      3                   => 'three',
      4                   => 'four',
      5                   => 'five',
      6                   => 'six',
      7                   => 'seven',
      8                   => 'eight',
      9                   => 'nine',
      10                  => 'ten',
      11                  => 'eleven',
      12                  => 'twelve',
      13                  => 'thirteen',
      14                  => 'fourteen',
      15                  => 'fifteen',
      16                  => 'sixteen',
      17                  => 'seventeen',
      18                  => 'eighteen',
      19                  => 'nineteen',
      20                  => 'twenty',
      30                  => 'thirty',
      40                  => 'fourty',
      50                  => 'fifty',
      60                  => 'sixty',
      70                  => 'seventy',
      80                  => 'eighty',
      90                  => 'ninety',
      100                 => 'hundred',
      1000                => 'thousand',
      1000000             => 'million',
      1000000000          => 'billion',
      1000000000000       => 'trillion',
      1000000000000000    => 'quadrillion',
      1000000000000000000 => 'quintillion'
    );

    if (preg_match("/[^0-9\-.]/", (string)$number) or $number > PHP_INT_MAX) {
      return false;
    }

    #negative check
    if ($number < 0) {
      return $minus . $this->number_to_words(abs($number));
    }

    #decimal check & separate
    if ( strpos($number, '.') !== false ) {
      list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
      #under 21 just use dictonary
      case $number < 21:
        $string = $dictionary[$number];
        break;

      #under 100 to over 21
      case $number < 100:
        $tens   = ((int)($number / 10)) * 10;
        $units  = $number % 10;
        $string = $dictionary[$tens];
        if ($units) {
            $string .= $hyphen . $dictionary[$units];
        }
        break;

      #under 1000 to over 100
      case $number < 1000:
        $hundreds  = $number / 100;
        $remainder = $number % 100;
        $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
        if ($remainder) {
          $string .= $and . $this->number_to_words($remainder);
        }
        break;

      #under 10000
      default:

        #pick up over 1000 number
        $baseUnit = pow(1000, floor(log($number, 1000)));
        $numBaseUnits = (int)($number / $baseUnit);

        $remainder = $number % $baseUnit;
        $string = $this->number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
        if ($remainder) {
            $string .= $remainder < 100 ? $and : $separator;
            $string .= $this->number_to_words($remainder);
        }
        break;
    }

    #add decimal
    if (null !== $fraction && is_numeric($fraction)) {
      $string .= $decimal;
      $words = array();
      foreach (str_split( (string) $fraction) as $number) {
        $words[] = $dictionary[$number];
      }
      $string .= implode(' ', $words);
    }

    return $string;
  }
}