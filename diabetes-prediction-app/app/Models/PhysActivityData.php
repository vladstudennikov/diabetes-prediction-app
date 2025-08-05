<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysActivityData extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'phys_activity_data';
    
    protected $fillable = [
        'user_id',
        'date',
        'activity_name',
        'duration',
    ];
}
