<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','assigned_to','company_name','photo','phone','address','vat_number'];
    public function proposals()
    {
        return $this->hasMany(Proposal::class ,'user_id','id');
    }
     public function user()
    {
        return $this->belongsTo(User::class,'user_id','id',);
    }
}

