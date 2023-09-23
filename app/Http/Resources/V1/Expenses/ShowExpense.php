<?php

namespace App\Http\Resources\V1\Expenses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowExpense extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->resource->user;
        return [
            "data" =>
            [
                "id" => $this->resource->id,
                "description" => $this->resource->description_expense,
                "value" => $this->resource->value_expense,
                "date" => $this->resource->date_expense,
                "updatedAt" => $this->resource->updated_at,
                "createdAt" => $this->resource->created_at,
                "creator" => [
                    "id" => $user->id,
                    "name" => $user->name,
                ]
                    
            ]
        ];
    }
}
