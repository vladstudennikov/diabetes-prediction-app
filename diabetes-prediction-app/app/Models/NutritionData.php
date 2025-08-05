<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionData extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'nutrition_data';
    
    protected $fillable = [
        'user_id',
        'date',
        'meal_name',
        'dish_name',
    ];
}
