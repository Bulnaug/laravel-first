<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = ['title', 'amount'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}