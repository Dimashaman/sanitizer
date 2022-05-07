<?php

namespace Dima\Sanitizer;

use Exception;
use InvalidArgumentException;

class Sanitizer
{
    private RuleSet $ruleSet;

    /**
     * @param RuleSet $ruleSet
     */
    public function setRuleSet(RuleSet $ruleSet): void
    {
        $this->ruleSet = $ruleSet;
    }

    /**
     * @param DataSet $dataSet
     */
    public function setDataSet(DataSet $dataSet): void
    {
        $this->dataSet = $dataSet;
    }

    private DataSet $dataSet;
    private array $errors;
    private array $result;

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }

    public function __construct(array $rules, string $json)
    {
        if (!$rules) {
            throw new InvalidArgumentException('Data passed to validator is not an array');
        }

        if (!$this->isJson($json)) {
            throw new InvalidArgumentException('Abort. This is not a valid json');
        }

        $this->dataSet = new DataSet($json);
        $this->ruleSet = new RuleSet($rules);
    }

    /**
     * @throws Exception
     */
    public function validate(): array
    {
        $this->reset();

        $result = [];
        $errors = [];

        $compareStructure = array_diff_key($this->dataSet->getData(), $this->ruleSet->getRules());

        if (count($compareStructure)) {
            throw new Exception(sprintf('Abort. Invalid Structure, missing keys: %s', implode(',', $compareStructure)));
        }
        foreach ($this->dataSet->getData() as $key => $value) {
            $validationResult = $this->ruleSet->getByKey($key)->validate($value);

            if ($validationResult->hasError()) {
                $errors[$key] = $validationResult->getMessage();
            } else {
                $result[$key] = $validationResult->getValidatedValue();
            }

        }

        $this->errors = $errors;
        $this->result = $result;

        return count($errors) ? $errors : $result;
    }

    private function reset(): void
    {
        $this->errors = [];
        $this->result = [];
    }

    private function isJson($string): bool
    {
        json_decode($string, true);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
