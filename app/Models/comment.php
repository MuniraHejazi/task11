<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'user_id', 'post_id'];

    public function post()
{
    return $this->belongsTo(Post::class);
}
}
