<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function comments()
    {
        return  $this->hasMany(Comment::class, 'post_id', 'id')->take(5)->latest();
    }

    public function readable_time_format()
    {
        // dd((strtotime($this->created_at)));
        if (time() <=  strtotime($this->created_at) + 2592000) {
            return $this->created_at->diffForHumans();
        }
        return Carbon::parse($this->created_at)->translatedFormat('j F Y');
    }
}
