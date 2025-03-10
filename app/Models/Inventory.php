<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;
    protected $table="inventory";
    protected $fillable=[
        'category_id',
        'bar_code',
        'serie',
        'description',
        'stock',
        'supplier_id',
        'purchase_price',
        'sale_price',
        'wholesale_price',
        'photo'
    ];
    public function user()
    {
        return $this->belongsTo(Category::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
