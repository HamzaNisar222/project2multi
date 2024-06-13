<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorServiceRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'service_id',
        'document_path',
        'status',
    ];

    public function vendor() {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
