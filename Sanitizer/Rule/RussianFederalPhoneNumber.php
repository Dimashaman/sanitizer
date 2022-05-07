<?php

namespace Dima\Sanitizer\Rule;

class RussianFederalPhoneNumber extends AbstractRule
{
    protected string $message = 'This input must be a correct phone number';

    public function validate($value): AbstractRule
    {
        $this->reset();

        if (!is_scalar($value) || preg_match('/^((8|\+7|7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', (string)$value) > 0) {
            $this->validatedValue = '7' . preg_replace('/^(\+|7|8)+|(\D)/', '', $value);
        } else {
            $this->setError();
        }

        return $this;
    }
}
