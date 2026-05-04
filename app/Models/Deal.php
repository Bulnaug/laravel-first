<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    public const STATUSES = [
        'new',
        'in_progress',
        'won',
        'lost',
    ];

    protected $fillable = [
        'title',
        'amount',
        'status',
        'contact_id',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}