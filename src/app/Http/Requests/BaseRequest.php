<?php

namespace src\app\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    public function withValidator(Validator $validator): void
    {
        if (!$validator->fails()) {
            $validator->after(function (Validator $validator) {
                $this->additionalCheck($validator);
            });
        }
    }

    public function additionalCheck(Validator $validator): void
    {
        // nothing
    }

    protected function getParamValueStr(string $paramName): ?string
    {
        return $this->has($paramName) ? (null === $this->input($paramName) ? null : $this->input($paramName)) : null;
    }

    protected function getParamValueInt(string $paramName): ?int
    {
        return $this->has($paramName) ? (null === $this->input($paramName) ? null : (int)$this->input($paramName)) : null;
    }

    protected function getParamValueFloat(string $paramName): ?float
    {
        return $this->has($paramName) ? (null === $this->input($paramName) ? null : (float)$this->input($paramName)) : null;
    }

    protected function getParamValueBool(string $paramName): ?bool
    {
        return $this->has($paramName) ? (null === $this->input($paramName) ? null : (bool)$this->input($paramName)) : null;
    }

    protected function getParamValueArr(string $paramName): ?array
    {
        return $this->input($paramName);
    }

    public function getPathParamValueStr(string $paramName): ?string
    {
        return $this->route($paramName);
    }

    public function getPathParamValueInt(string $paramName): ?int
    {
        return null === $this->route($paramName) ? null : (int)$this->route($paramName);
    }

    protected function toLogArray(array $notLogElements = []): ?array
    {
        return $this->removeElementWithNotLogKey($this->toArray(), $notLogElements);
    }

    private function removeElementWithNotLogKey(array $array, array $notLogElements): ?array
    {
        foreach ($array as $subKey => $subArray) {
            if (in_array($subKey, $notLogElements, true)) {
                unset($array[$subKey]);
            } elseif (is_array($subArray) && count($subArray) !== 0) {
                $array[$subKey] = $this->removeElementWithNotLogKey($subArray, $notLogElements);
            }
        }

        return $array;
    }
}