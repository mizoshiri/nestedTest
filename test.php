<?php
require('./nested.php');
require('./convert.php');

class bbrTest extends PHPUnit_Framework_TestCase
{
    public function testShowTree()
    {
        $nested = New Nested();

        # array check
        $data = "array check";
        $this->assertFalse($nested->show_tree($data));

        # Check nested
        $array = array(
          1 => 'one',
          2 => array(
            21 => 'thirty-one'
          ),
          3 => 'three'
        );
        $this->assertEquals(substr_count($nested->show_tree($array), '<ul>'),2);

        $array = array(
          1 => array(
            11 => 'eleven'
          ),
          2 => array(
            21 => 'thirty-one'
          ),
          3 => 'three'
        );
        $this->assertEquals(substr_count($nested->show_tree($array), '<ul>'),3);
    }
}