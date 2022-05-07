<?php

namespace Dima\Sanitizer;

class RuleSet
{
    private array $rules;

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function getByKey($key)
    {
        return $this->rules[$key];
    }
}
