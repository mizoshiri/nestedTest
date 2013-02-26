<?php

class Nested{

  # sum keys from nested data
  public function sum_key($data)
  {
    static $keySum = 0;
    if( !is_array($data) ) {
      return 0;
    }
    foreach( $data as $key => $value ) {
      if (is_array($value)) {

        $keySum += (int)$key;
        $this->sum_key($value);
      } else {
        $keySum += (int)$key;
      }
    }
    return (int)$keySum;
  }

  function show_tree($data)
  {
    static $result = false;
    if( !is_array($data) ) {
      return $result;
    }
    $end = false;

    $result .= "<ul>";
    foreach($data as $key => $value) {
      if (is_array($value)) {
        $result .=  "</li><li>" .  $key;
        $this->show_tree($value);
      } else {
        if ($end) {
          $result .=  "</li>";
          $end = false;
        }
        $result .=  '<li>' .  $key . ' = ';
        $result .=  $value;
        $end = true;
      }
    }
    if ($end) {
      $result .=  "</li>";
    }
    $result .=  "</ul>";

    return $result;
  }
}
