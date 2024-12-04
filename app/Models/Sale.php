<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $primaryKey = 'sale_id'; // Specify the primary key column
    public $incrementing = true;         // If you're using an auto-incrementing integer
    protected $keyType = 'int'; 
    protected $fillable = [
        'branch_id',
        'user_id',
        'total_amount',
        'sale_date',
    ];
    public $timestamps = false;
    public function items()
    {
        return $this->hasMany(SalesItem::class, 'sale_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }
}
