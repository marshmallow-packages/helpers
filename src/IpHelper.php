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
        if (!$this->isv6($ip_address)) {
            return $ip_address;
        }

        $ip_address = $this->genereteFullIpv6($ip_address);
        return hexdec(substr($ip_address, 0, 2)). "." . hexdec(substr($ip_address, 2, 2)). "." . hexdec(substr($ip_address, 5, 2)). "." . hexdec(substr($ip_address, 7, 2));
    }

    public function isv4($ip_address)
    {
        return (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) ? true : false;
    }

    public function genereteFullIpv6($ip_address)
    {
        $groups_array = explode(':', $ip_address);

        /**
         * Handle "::". This means a multiple amount of full zero groups.
         * For instance: 2001:db8::1428:57ab should convert to 2001:0db8:0000:0000:0000:0000:1428:57ab.
         * This should only be performed if the group count is not the
         * maximum amount of 8.
         */
        if (count($groups_array) !== 8) {
            $amount_of_full_zero_groups = 8 - count($groups_array) + 2;
            $zero_group_string = str_pad('', $amount_of_full_zero_groups, ':', STR_PAD_LEFT);
            $ip_address = str_replace('::', $zero_group_string, $ip_address);
            $groups_array = explode(':', $ip_address);
        }

       /**
        * Make sure that all the groups have 4 characters. In the IPv6 protocal,
        * it is allowed to not display leading zeros. Our IPv4 to IPv6 convertor
        * needs the ip address to contain of all groups of 4. There for
        * "2001:db8" should be converted to "2001:0db8".
        */
        $groups = collect($groups_array)->map(function ($group) {
            return str_pad($group, 4, '0', STR_PAD_LEFT);
        });

        /**
         * Return a normal IPv6 string value like:
         * 2001:0db8:0000:0000:0000:0000:1428:57ab
         */
        return $groups->join(':');
    }

    public function isv6($ip_address)
    {
        $ip_address = $this->genereteFullIpv6($ip_address);
        return (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) ? true : false;
    }
}
