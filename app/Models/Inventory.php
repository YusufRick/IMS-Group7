<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventory'; // Specify the table name

    protected $primaryKey = 'inventory_id';


    protected $fillable = [
        'branch_id', 
        'product_id', 
        'quantity', 
        'min_quantity'
    ];

    // Relationship with the Branch model
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    // Relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    
}
