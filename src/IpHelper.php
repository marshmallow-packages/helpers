<?php

namespace Marshmallow\HelperFunctions;

class IpHelper
{
    public function forcedIpv4($ip_address = null)
    {
        if (! $ip_address) {
            $ip_address = request()->ip();
        }


        if ($this->isv6($ip_address)) {
            return $this->convert6to4($ip_address);
        }

        return $ip_address;
    }

    public function convert6to4($ip_address)
    {
        return hexdec(substr($ip_address, 0, 2)). "." . hexdec(substr($ip_address, 2, 2)). "." . hexdec(substr($ip_address, 5, 2)). "." . hexdec(substr($ip_address, 7, 2));
    }

    public function isv4($ip_address)
    {
        return (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) ? true : false;
    }

    public function isv6($ip_address)
    {
        return (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) ? true : false;
    }
}
