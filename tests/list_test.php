<?php

require_once $rootpath.'/src/class/list_class.php';

use PHPUnit\Framework\TestCase;

class listTest extends TestCase
{
    //测试首页获取联系人总表
    public function testlistInit()
    {
        $expected = '0';
        $list = new list_class();
        $actual = $list->init('admin');
        $this->assertEquals($expected, $actual->code);
    }
    //测试添加联系人
    public function testlistTianJia()
    {
        $expected = 'ok';
        $list = new list_class();
        $actual = $list->TianJia('姓名=test&拼音=test&公司=&手机=&座机=&邮箱=&备注=&组=&性别=','testguid');
        $this->assertEquals($expected, $actual);
    }
    //测试查看详细
    public function testlistXiangXi()
    {
        $expected = 'testguid';
        $list = new list_class();
        $actual = $list->XiangXi('testguid');
        $this->assertEquals($expected, $actual->data[0]['GUID']);
    }
    //测试保存
    public function testlistBaoCun()
    {
        $expected = 'ok';
        $list = new list_class();
        $actual = $list->BaoCun('姓名=test&拼音=test&公司=test&手机=&座机=&邮箱=&备注=&组=&性别=','testguid');
        $this->assertEquals($expected, $actual);
        
        $expected = 'test';
        $actual = $list->XiangXi('testguid');
        $this->assertEquals($expected, $actual->data[1]['NEI_RONG']);
    }
    //测试删除
    public function testlistShanChu()
    {
        $expected = 'ok';
        $list = new list_class();
        $actual = $list->ShanChu('testguid');
        $this->assertEquals($expected, $actual);
    }
}
