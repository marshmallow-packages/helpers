<?php

namespace Marshmallow\HelperFunctions\Tests\Unit;

use Marshmallow\HelperFunctions\Facades\Str;
use Marshmallow\HelperFunctions\Tests\TestCase;

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

    /** @test */
    public function it_can_remove_a_part_of_a_string()
    {
        $this->assertEquals(
            Str::remove('Marshmallow.dev', '.dev'),
            'Marshmallow'
        );
    }

    /** @test */
    public function test_it_returns_the_correct_single_version()
    {
        $parts = ['Stef'];
        $string = Str::join($parts);
        $this->assertEquals('Stef', $string);
    }

    /** @test */
    public function test_it_resturns_the_and_variable_with_to_items()
    {
        $parts = ['Stef', 'van'];
        $string = Str::join($parts);
        $this->assertEquals('Stef and van', $string);
    }

    /** @test */
    public function test_it_returns_the_comma_and_variable_with_tree_items()
    {
        $parts = ['Stef', 'van', 'Esch'];
        $string = Str::join($parts);
        $this->assertEquals('Stef, van and Esch', $string);
    }

    /** @test */
    public function test_it_returns_the_comma_and_variable_with_five_items()
    {
        $parts = ['Stef', 'van', 'Esch', 'Mr', 'Mallow'];
        $string = Str::join($parts);
        $this->assertEquals('Stef, van, Esch, Mr and Mallow', $string);
    }

    /** @test */
    public function test_it_can_overule_the_comma_attribute()
    {
        $parts = ['Stef', 'van', 'Esch'];
        $string = Str::join($parts, ' and ', '### ');
        $this->assertEquals('Stef### van and Esch', $string);
    }

    /** @test */
    public function test_it_can_overule_the_and_attribute()
    {
        $parts = ['Stef', 'van', 'Esch'];
        $string = Str::join($parts, ' ### ');
        $this->assertEquals('Stef, van ### Esch', $string);
    }
    /** @test */
    public function test_it_returns_null_when_no_parts_are_availbel()
    {
        $string = Str::join([]);
        $this->assertNull($string);
    }
}
