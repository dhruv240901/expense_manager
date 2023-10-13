<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable=['holder_name','account_number','phone_number','email','owner_id'];

    public function otheraccount()
    {
        return $this->hasMany(OtherAccount::class,'account_id');
    }
}
