<?php

namespace Dima\Sanitizer\Rule;

use PHPUnit\Framework\TestCase;

class IntegerTypeTest extends TestCase
{
    public function testValidation()
    {
        $rule = new IntegerType();

        $this->assertEquals(40, $rule->validate(40)->getValidatedValue());
        $this->assertEquals(null, $rule->validate('abc')->getValidatedValue());
        $this->assertEquals(null, $rule->validate('123abc123')->getValidatedValue());
        $this->assertNull($rule->validate(38)->getMessage());
        $this->assertNotNull($rule->validate(38.7)->getMessage());
    }
}
