<?php

require_once $rootpath.'/src/class/list_class.php';

use PHPUnit\Framework\TestCase;

class listTest extends TestCase
{
    public function testlistInit()
    {
        $expected = '0';

        $list = new list_class();
        $actual = $list->init('admin');

        $this->assertEquals($expected, $actual->code);
    }
}
