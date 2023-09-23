<?php

namespace App\Http\Resources\V1\Expenses;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexExpense extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $collection = $this->collection;
        return $collection->map(function ($item) {
            $user = $item->user;
            return [
                "id" => $item->id,
                "description" => $item->description_expense,
                "value" => $item->value_expense,
                "date" => $item->date_expense,
                "updatedAt" => $item->updated_at,
                "createdAt" => $item->created_at,
                "creator" => [
                    "id" => $user->id,
                    "name" => $user->name,
                ]

            ];
        })->toArray();
    }
}
