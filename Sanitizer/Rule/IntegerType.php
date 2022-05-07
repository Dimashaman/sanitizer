<?php

namespace Dima\Sanitizer\Rule;

class IntegerType extends AbstractRule
{
    protected string $message = 'This input must be an integer number';

    public function validate($value): AbstractRule
    {
        $this->reset();

        if (filter_var($value, FILTER_VALIDATE_INT) || (string)$value === '0') {
            $this->validatedValue = (int)$value;
        } else {
            $this->setError();
        }

        return $this;
    }
}
