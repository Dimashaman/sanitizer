<?php

namespace Dima\Sanitizer\Rule;

use PHPUnit\Framework\TestCase;

class FloatTypeTest extends TestCase
{


    public function testValidation()
    {
        $rule = new FloatType();

        $this->assertEquals(40.25, $rule->validate(40.25)->getValidatedValue());
        $this->assertEquals(null, $rule->validate('abc')->getValidatedValue());
        $this->assertEquals(null, $rule->validate('123abc123')->getValidatedValue());
        $this->assertNotNull($rule->validate('123abc123')->getMessage());
        $this->assertNull($rule->validate(38)->getValidatedValue());
        $this->assertNull($rule->validate(38.2)->getMessage());
        $this->assertNotNull($rule->validate(38.7)->getValidatedValue());
    }
}
