<?php

namespace Dima\Sanitizer\Rule;

use PHPUnit\Framework\TestCase;

class ArraySameTypeTest extends TestCase
{
    public function testValidation()
    {
        $rule = new ArraySameType(StringType::class);

        $this->assertEquals(['hello', 'world'], $rule->validate(['hello', 'world'])->getValidatedValue());
        $this->assertNull($rule->validate(['hello', 'world', 1])->getValidatedValue());
        $this->assertEquals('This input must be a same typed array', $rule->validate(['hello', 'world', 1])->getMessage());
    }
}
