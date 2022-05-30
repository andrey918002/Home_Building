<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $fillable =[
        'event_name',
        'start_name',
        'end_name'
    ];
}
