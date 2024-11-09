<?php

namespace App\Exports;

use App\Models\Package;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PackagesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Package::with(['store', 'status', 'commune', 'commune.wilaya', 'deliveryType'])
            ->get()->map(function ($package) {
                return [
                    'tracking_code' => $package->tracking_code,
                    'store_name' => $package->store->name,
                    'package_name' => $package->package_name,
                    'status' => $package->status->id,
                    'client_full_name' => $package->client_first_name . ' ' . $package->client_last_name,
                    'phone' => $package->client_phone,
                    'wilaya' => $package->commune->wilaya->name,
                    'commune' => $package->commune->name,
                    'delivery_type' => $package->deliveryType->name,
                    'status_name' => $package->status->name,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Tracking Code',
            'Store Name',
            'Package Name',
            'Status',
            'Client Full Name',
            'Phone',
            'Wilaya',
            'Commune',
            'Delivery Type',
            'Status Name',
        ];
    }
}
