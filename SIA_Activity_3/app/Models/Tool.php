<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'tool_name',
        'category',
        'serial_number',
        'price',
        'purchase_date',
        'status',
        'storage_location',
        'assigned_to',
        'image_path',
        'image_url',
    ];
}
