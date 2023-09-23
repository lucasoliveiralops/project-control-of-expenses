<?php

namespace App\Http\Resources\V1\Account;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Login extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "data" =>
            [
                "accessToken" => $this->resource,
                "tokenType" => "Bearer",
            ]
        ];
    }
}
