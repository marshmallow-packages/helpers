<?php

namespace Marshmallow\HelperFunctions\Tests\Unit;

use Marshmallow\HelperFunctions\Tests\TestCase;
use Marshmallow\HelperFunctions\Facades\Str;

class StrTest extends TestCase
{
    /** @test */
    public function it_can_clean_a_phone_number()
    {
    	$this->assertEquals(Str::cleanPhoneNumber('+316 28 998-954'), '31628998954');
    }

    /** @test */
    public function it_can_return_a_numbers_only_string()
    {
    	$this->assertEquals(Str::numbersOnly('12 ABC 34'), '1234');
    }

    /** @test */
    public function it_can_return_only_numbers_and_letters()
    {
    	$this->assertEquals(Str::numbersAndLettersOnly('12-ABC ### 34'), '12ABC34');
    }

    /** @test */
    public function it_can_return_a_phone_number_with_country_code()
    {
        $this->assertEquals(
            Str::phonenumberWithCountryCode('0628998954'),
            '+31628998954'
        );
        $this->assertEquals(
            Str::phonenumberWithCountryCode('0031628998954'),
            '+31628998954'
        );
        $this->assertEquals(
            Str::phonenumberWithCountryCode('31628998954'),
            '+31628998954'
        );
        $this->assertEquals(
            Str::phonenumberWithCountryCode('+31628998954'),
            '+31628998954'
        );

        /**
         * Without a + for zero's replacement
         */
        $this->assertEquals(
            Str::phonenumberWithCountryCode('0628998954', '31', false),
            '0031628998954'
        );
        $this->assertEquals(
            Str::phonenumberWithCountryCode('0031628998954', '31', false),
            '0031628998954'
        );
        $this->assertEquals(
            Str::phonenumberWithCountryCode('31628998954', '31', false),
            '0031628998954'
        );
        $this->assertEquals(
            Str::phonenumberWithCountryCode('+31628998954', '31', false),
            '0031628998954'
        );
    }
}
