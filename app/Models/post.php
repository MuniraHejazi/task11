<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $fillable = [  'title','description', 'image', 'user_id','category_id'];

    public function User(){
    return $this->belongsTo(User::class);
    }

    public function category(){
     return $this->belongsTo(Category::class);
    }
    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
   {
    return $this->hasMany(Comment::class);
   }
}
