<?php

namespace Dima\Sanitizer\Rule;

class ArraySameType extends AbstractRule
{
    protected string $message = 'This input must be a same typed array';

    public function validate($value): AbstractRule
    {
        $this->reset();
        $typeRule = new $this->options();

        foreach ($value as $element) {
            if ($typeRule->validate($element)->hasError()) {
                $this->setError();
                break;
            }
        }

        $this->validatedValue = $this->hasError() ? null : $value;

        return $this;
    }
}
