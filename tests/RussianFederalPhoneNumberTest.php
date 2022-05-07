<?php

namespace Dima\Sanitizer\Rule;

use PHPUnit\Framework\TestCase;

class RussianFederalPhoneNumberTest extends TestCase
{
    public function testValidation()
    {
        $rule = new RussianFederalPhoneNumber();

        $this->assertEquals("79502885623", $rule->validate("8 (950) 288-56-23")->getValidatedValue());
        $this->assertNotNull($rule->validate("260557")->getMessage());
        $this->assertEquals("74242242626", $rule->validate('+7 4242 24-26-26')->getValidatedValue());
        $this->assertEquals("74242242626", $rule->validate('7 4242 24-26-26')->getValidatedValue());
        $this->assertNull($rule->validate('1.23')->getValidatedValue());
        $this->assertNull($rule->validate('123 world')->getValidatedValue());
    }
}
