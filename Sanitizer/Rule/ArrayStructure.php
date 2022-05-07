<?php

namespace Dima\Sanitizer\Rule;

class ArrayStructure extends AbstractRule
{
    protected string $message = 'This input must have correct structure';

    public function validate($value): AbstractRule
    {
        $this->reset();

        foreach (new \RecursiveIteratorIterator(new \RecursiveArrayIterator($value), \RecursiveIteratorIterator::CATCH_GET_CHILD) as $key => $item) {
            if (!is_int($key)) {
                $rule = $this->options[$key];

                $rule->validate($item);

                if ($rule->hasError()) {
                    $this->setError();
                    break;
                }
            }
        }

        $this->validatedValue = $this->hasError() ? null : $value;

        return $this;
    }
}
