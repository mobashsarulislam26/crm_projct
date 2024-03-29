<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        'invoice_id ',
        'user_id',
        'paymentMethod_id',
        'amount',

    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }
    public function user()
    {
      return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function paymentMethod()
    {
      return $this->hasOne(PaymentMethod::class, 'id', 'paymentMethod_id');
    }


}
