<?php

namespace App\Models;

use App\Models\Models;
use App\Models\TypeEquipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ServiceOrder extends Model
{
    use HasFactory;

    protected $table="serviceorder";

    protected $fillable=[
        'code',
        'date',
        'responsibleTechnicial_id',
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
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'responsibleTechnicial_id','id');
        
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
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
        return $this->belongsTo(TypeEquipment::class, 'type_of_equipment_id','id');
    }
}
