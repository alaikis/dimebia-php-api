<?php
/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/4/14 11:55
 */
namespace Alaikis\Dimebia\Tests;

use Alaikis\Dimebia\Dimebia;

class TestClass
{
    public  static function clientTest ()
    {
        $cl = new Dimebia("","");
        $cl->channel->channelList([]);
    }
}
TestClass::clientTest();
