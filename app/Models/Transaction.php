<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable=['account_id','amount','transactiontype_id','transactioncategory_id','receiveraccount_id'];

    public function category()
    {
        return $this->belongsTo(TransactionCategory::class,'transactioncategory_id');
    }
    public function receiveraccount()
    {
        return $this->belongsTo(Account::class,'receiveraccount_id');
    }
    public function senderaccount()
    {
        return $this->belongsTo(Account::class,'account_id');
    }
}
