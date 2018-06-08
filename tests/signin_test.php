<?php
require_once dirname(__FILE__).'/../src/controller/class/signin_class.php';

// backward compatibility
if (!class_exists('\PHPUnit\Framework\TestCase') &&
    class_exists('\PHPUnit_Framework_TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
}

class signinTest extends PHPUnit_Framework_TestCase {
  public function testLoginSuccess() {
    $expected = 'admin';

    $userid = 'admin';
    $password = 'c3284d0f94606de1fd2af172aba15bf3';
    $lang = 'CN';
    
    $sign = new signin_class;
    $_SERVER['REMOTE_ADDR']='127.0.0.1';
    $actual = $sign->signin($userid,$password,$lang);

    $this->assertEquals($expected,$actual);
  }

  function testLoginFail() {
    $expected = 'warning';

    $userid = '11111';
    $password = '11111';
    $lang = 'CN';

    $sign = new signin_class;
    $actual = $sign->signin($userid,$password,$lang);
    $this->assertEquals($expected,$actual);
  }
}
?>