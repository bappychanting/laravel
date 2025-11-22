<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResponse extends JsonResource
{
    private ?Request $request;

    public function getRequestData(): ?Request
    {
        return $this->request;
    }

    public function toArray($request): array
    {
        // only store if it's an instance of Request
        $this->request = $request instanceof Request ? $request : null;

        return $this->toArrayResponse();
    }

    abstract public function toArrayResponse(): array;
}
