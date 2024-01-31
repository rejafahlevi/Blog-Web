<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'birdies_id',
        'body'
    ];

    public function bird(): BelongsTo
    {
        return $this->belongsTo(Birdy::class, 'birdies_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
