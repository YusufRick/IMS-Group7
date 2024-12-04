<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // This should match the table name
    protected $primaryKey = 'id'; // Ensure this is set correctly

    // Specify fillable attributes
    protected $fillable = [
        'product_name',
        'sku',
        'price',
        'category',
        'branch_id',
        'description'
    ];

    // Define the relationship to Branch if necessary
    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id','branch_id');
    }
    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
    public function salesItems()
    {
        return $this->hasMany(SalesItem::class, 'product_id', 'id'); // Define the relationship with SaleItem
    }
}
