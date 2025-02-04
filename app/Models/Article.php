<?php

namespace App\Models;


use App\Models\Place;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'place_id',
    ];

    // One Article belongs to One Place
    public function place(): BelongsTo {
        return $this->belongsTo(Place::class);
    }
}
