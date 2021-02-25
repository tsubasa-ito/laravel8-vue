<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
    use HasFactory;
    protected $fillable = [
        'content', 'user_id'
    ];
}
