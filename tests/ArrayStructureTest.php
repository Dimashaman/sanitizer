<?php

namespace Dima\Sanitizer\Rule;

use PHPUnit\Framework\TestCase;

class ArrayStructureTest extends TestCase
{


    public function testValidation()
    {
        $structure = ["foo" => (new StringType()), "bar" => (new IntegerType()), "baz" => (new RussianFederalPhoneNumber())];
        $rule = new ArrayStructure($structure);

        $this->assertNotNull($rule->validate(["foo" => "1", "bar" => 1, "baz" => '+79963433704'])->getValidatedValue());
        $this->assertNotNull($rule->validate(["foo" => "1", "bar" => "abc", "baz" => '2605066'])->getMessage());
        $this->assertEquals('This input must have correct structure', $rule->validate(["foo" => "1", "bar" => "abc", "baz" => '2605066'])->getMessage());
    }

    public function testComplexStructure()
    {
        $structure = ["foo" => (new StringType()), "bar" => (new IntegerType()), "baz" => (new RussianFederalPhoneNumber()), "biz" => (
        new ArraySameType(new StringType())
        )];
        $rule = new ArrayStructure($structure);

        $this->assertNotNull($rule->validate(["foo" => "1", "bar" => 1, "baz" => '+79963433704', "biz" => ['hello', 'world']])->getValidatedValue());
        $this->assertNotNull($rule->validate(["foo" => "1", "bar" => "abc", "baz" => '2605066'])->getMessage());
        $this->assertEquals('This input must have correct structure', $rule->validate(["foo" => "1", "bar" => "abc", "baz" => '2605066'])->getMessage());
        $this->assertEquals('This input must have correct structure', $rule->validate(["foo" => "1", "bar" => "abc", "baz" => '2605066', "biz" => ['hello', 1]])->getMessage());
        $this->assertEquals(["foo" => "1", "bar" => 2, "baz" => '+79963433704', "biz" => ['hello', 'world']], $rule->validate(["foo" => "1", "bar" => 2, "baz" => '+79963433704', "biz" => ['hello', 'world']])->getValidatedValue());
    }

    public function testRecursiveStructure()
    {
        $substructure = ['name' => (new StringType()), 'phone' => (new RussianFederalPhoneNumber()), 'contacts' => (new ArraySameType(StringType::class))];
        $structure = ["id" => (new IntegerType()), "userdata" => (new ArrayStructure($substructure))];

        $rule = new ArrayStructure($structure);

        $this->assertNotNull($rule->validate(["id" => 1, "userdata" => ['name' => 'ivan', "phone" => "+79963433704", "contacts" => ['John', 'Ada']]])->getValidatedValue());
        $this->assertNotNull($rule->validate(["id" => 1, "userdata" => ['name' => 44, "phone" => "+79963433704"]])->getMessage());
    }
}
