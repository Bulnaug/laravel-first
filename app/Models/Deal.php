<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
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
        'notes',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}