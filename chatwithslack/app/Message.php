<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message', 'file', 'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);

    }

}
