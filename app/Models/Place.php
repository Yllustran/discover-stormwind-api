<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model {

    protected $fillable = [
        'name',
        'description',
        'image',
        'latitude',
        'longitude',
        'category_id',
    ];

    // One Place belongs to One Category
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    // One Place can have many Article
    public function articles(): HasMany {
        return $this->hasMany(Article::class);
    }
}