<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $fillable=['sender_id','account_id','is_approved'];

    protected $table='requests';

    public function accounts()
    {
        return $this->belongsTo(Account::class,'account_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }
}
