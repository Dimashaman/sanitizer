<?php

namespace Dima\Sanitizer\Rule;

class FloatType extends AbstractRule
{
    protected string $message = 'This input must be a float number';

    public function validate($value): AbstractRule
    {
        $this->reset();

        if (is_float($value)) {
            $this->validatedValue = floatval($value);
        } else {
            $this->setError();
        }

        return $this;
    }
}
