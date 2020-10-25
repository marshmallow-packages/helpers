<?php

namespace Marshmallow\HelperFunctions\Tests\Unit;

use Marshmallow\HelperFunctions\Facades\Ip;
use Marshmallow\HelperFunctions\Tests\TestCase;

class IpTest extends TestCase
{
    protected function doIpv6Test($ipv6)
    {
        $ipv4 = Ip::convert6to4($ipv6);
        $this->assertTrue(Ip::isv4($ipv4));
        $this->assertTrue(Ip::isv6($ipv6));
    }

    /** @test */
    public function it_can_return_a_forced_ipv4_from_ipv4()
    {
        $ipv4 = '83.81.194.112';
        $ipv4 = Ip::forcedIpv4($ipv4);
        $this->assertTrue(Ip::isv4($ipv4));
    }

    /** @test */
    public function it_will_get_ip_from_request_if_not_provided()
    {
        $ipv4 = '83.81.194.112';
        $ipv4 = Ip::forcedIpv4();
        $this->assertEquals($ipv4, '127.0.0.1');
    }

    /** @test */
    public function it_can_return_a_forced_ipv4_from_ipv6()
    {
        $ipv6 = '2001:0db8:85a3:0000:1319:8a2e:0370:7344';
        $ipv4 = Ip::forcedIpv4($ipv6);
        $this->assertTrue(Ip::isv4($ipv4));
    }

    /** @test */
    public function it_can_convert_all_types_of_ipv6_to_ipv4_test_1()
    {
        $this->doIpv6Test('2001:0db8:85a3:0000:1319:8a2e:0370:7344');
    }

    /** @test */
    public function it_can_convert_all_types_of_ipv6_to_ipv4_test_2()
    {
        $this->doIpv6Test('2001:db8:85a3::1319:8a2e:370:7344');
    }

    /** @test */
    public function it_can_convert_all_types_of_ipv6_to_ipv4_test_3()
    {
        $this->doIpv6Test('2001:0db8:0000:0000:0000:0000:1428:57ab');
    }

    /** @test */
    public function it_can_convert_all_types_of_ipv6_to_ipv4_test_4()
    {
        $this->doIpv6Test('2001:db8:::::1428:57ab');
    }

    /** @test */
    public function it_can_convert_all_types_of_ipv6_to_ipv4_test_5()
    {
        $this->doIpv6Test('2001:db8::1428:57ab');
    }

    /** @test */
    public function it_can_convert_all_types_of_ipv6_to_ipv4_test_6()
    {
        $ipv6 = '2001::db8::cade';
        $ipv4 = Ip::convert6to4($ipv6);
        $this->assertFalse(Ip::isv4($ipv4));
        $this->assertFalse(Ip::isv6($ipv6));
    }
}
