<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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
        'total'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'responsibleTechnicial_id','id');
        
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
