<?php

namespace App\Http\Requests\V1\Products;

use App\Http\Requests\BaseRequest;

class ProductListGetRequest extends BaseRequest implements IProductListGetRequest
{
    private const KEYWORD = 'keyword';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::KEYWORD => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }

    public function getKeyword(): ?string
    {
        return $this->getParamValueStr(self::KEYWORD);
    }
}
