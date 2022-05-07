<?php

namespace Dima\Sanitizer\Rule;

class StringType extends AbstractRule
{
    protected string $message = 'This input must be an string';

    public function validate($value): AbstractRule
    {
        $this->reset();

        if (is_string($value)) {
            $this->validatedValue = (string)$value;
        } else {
            $this->setError();
        }

        return $this;
    }
}
