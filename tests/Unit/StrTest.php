<?php

namespace Tests\Unit;

use Tests\TestCase;
use Marshmallow\HelperFunctions\Facades\Str;
class StrTest extends TestCase
{
    public function testcleanPhoneNumber()
    {
    	$this->assertEquals(Str::cleanPhoneNumber('+316 28 998-954'), '31628998954');
    }

    public function testNumbersOnly()
    {
    	$this->assertEquals(Str::numbersOnly('12 ABC 34'), '1234');
    }

    public function testNumbersAndLettersOnly()
    {
    	$this->assertEquals(Str::numbersAndLettersOnly('12-ABC ### 34'), '12ABC34');
    }
}
