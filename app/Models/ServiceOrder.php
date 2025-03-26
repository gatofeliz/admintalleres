<?php

namespace App\Models;

use App\Models\Models;
use App\Models\TypeEquipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $table = "serviceorder";

    protected $fillable = [
        'code',
        'date',
        'responsibleTechnicial_id',
        'tech',
        'customer_id',
        'imei',
        'brand_id',
        'model_id',
        'type_of_equipment_id',
        'turn_on',
        'blows',
        'tactile',
        'cargo_port',
        'colour',
        'password',
        'failure',
        'diagnosis',
        'budget',
        'repair',
        'advance',
        'total',
        'photos',
        'status',
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function model()
    {
        return $this->belongsTo(Models::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function typeEquipment()
    {
        return $this->belongsTo(TypeEquipment::class, 'type_of_equipment_id', 'id');
    }
}
