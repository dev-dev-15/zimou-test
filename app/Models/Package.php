<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Package extends Model
{
    Use HasFactory;

    protected $fillable = [
        'uuid',
        'tracking_number',
        'commune_id',
        'delivery_type_id',
        'status_id',
        'store_id',
        'address',
        'can_be_opened',
        'name',
        'client_first_name',
        'client_last_name',
        'client_phone',
        'client_phone2',
        'cod_to_pay',
        'commission',
        'status_updated_at',
        'delivered_at',
        'delivery_price',
        'extra_weight_price',
        'free_delivery',
        'packaging_price',
        'partner_cod_price',
        'partner_delivery_price',
        'partner_return',
        'price',
        'price_to_pay',
        'return_price',
        'total_price',
        'weight',
    ];

    protected $casts = [
        'can_be_opened' => 'boolean',
        'free_delivery' => 'boolean',
    ];

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function deliveryType()
    {
        return $this->belongsTo(DeliveryType::class);
    }

    public function status()
    {
        return $this->belongsTo(PackageStatus::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    // Events
    protected static function booted(): void
    {
        static::creating(function ($package) {
            $package->uuid = (string) Str::uuid();
            $package->tracking_code = 'ZIMOU-' . Str::upper(Str::random(15));
            $package->status_id = 1;
        });

        static::updating(function ($package) {
            if ($package->isDirty('status_id')) {
                $package->status_updated_at = now();
            }
        });
    }
}
