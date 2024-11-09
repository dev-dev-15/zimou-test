<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'email',
        'phone',
        'company_name',
        'capital',
        'address',
        'register_commerce_number',
        'nif',
        'legal_form_id',
        'status',
        'can_update_preparing_packages',
    ];

    protected $casts = [
        'status' => 'boolean',
        'can_update_preparing_packages' => 'boolean',
    ];
}
