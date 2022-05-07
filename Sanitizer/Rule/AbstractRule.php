<?php

namespace Dima\Sanitizer\Rule;


abstract class AbstractRule
{
    protected string $message;
    protected bool $error = false;
    protected mixed $value = null;
    protected mixed $options = null;
    protected mixed $validatedValue = null;

    abstract public function validate($value): AbstractRule;

    public function __construct(mixed $options = null)
    {
        if ($options) {
            $this->options = $options;
        }
    }

    public function getMessage(): ?string
    {
        if ($this->error) {
            return $this->message;
        }

        return null;
    }

    public function getValidatedValue(): mixed
    {
        return $this->validatedValue;
    }

    public function hasError(): bool
    {
        return $this->error;
    }

    protected function setError(): AbstractRule
    {
        $this->error = true;

        return $this;
    }

    protected function reset(): AbstractRule
    {
        $this->error = false;
        $this->validatedValue = null;

        return $this;
    }

    public function assignValue(mixed $value): AbstractRule
    {
        $this->value = $value;

        return $this;
    }
}
