<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = ['description_expense', 'user_id', 'value_expense', 'date_expense'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
