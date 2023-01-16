<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $guarded = [];

    public function product(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->belongsTo(Category::class);
    }
}
