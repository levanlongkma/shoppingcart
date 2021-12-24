<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function setBodyAtrribute($value) {
        $this->attributes['body'] = $value;
        $this->attributes['excerpt'] = Str::limit($value, 10);
    }

    public function category() {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
}
