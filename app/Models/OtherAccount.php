<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherAccount extends Model
{
    use HasFactory;

    protected $table='others_accounts';

    protected $fillable=['user_id','account_id'];

    public function account()
    {
        return $this->belongsTo(Account::class,'account_id');
    }
}
