<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Deal;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
}
