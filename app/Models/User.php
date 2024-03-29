<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'department_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function user()
    {
       return $this->hasMany(ProposalUser::class);
    }

    public function users()

    {
       return $this->hasMany(Proposal::class) ;
    }
    public function customers()
    {
       return $this->hasMany(Customers::class);
    }


protected function department()
    {
        return $this->belongsTo(Departments::class, 'department_id', 'id');
    }

    public function customer()
    {
        return $this->hasOne('App\Models\Customers', 'user_id', 'id');
    }

    public function assignedBy()
    {
        return $this->hasOne('App\Models\Customers', 'assigned_to', 'id');
    }








}
