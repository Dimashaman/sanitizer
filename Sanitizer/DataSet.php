<?php

namespace Dima\Sanitizer;

class DataSet
{
    private array $data;

    public function __construct($json)
    {
        $this->data = json_decode($json, true);
    }

    public function getData()
    {
        return $this->data;
    }
}
