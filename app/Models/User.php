<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

  
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password', 'phone', 'image', 'branch_id','subscription_type','status','role_type'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'user_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'generated_by');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class, 'user_id');
    }

}
