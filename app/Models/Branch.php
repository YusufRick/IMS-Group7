<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    protected $fillable = [
        'branch_name',
        'location',
        'contact_number',
        'status', // Add the status field to fillable
    ];
    // use HasFactory;
    protected $primaryKey = 'branch_id'; // Specify the primary key column
    public $incrementing = true;         // If you're using an auto-incrementing integer
    protected $keyType = 'int';          // Specify the key type

        public function inventory()
        {
            return $this->hasMany(Inventory::class, 'branch_id', 'branch_id');
        }
        public function manager()
        {
            return $this->belongsTo(User::class, 'branch_id');
        }
}
