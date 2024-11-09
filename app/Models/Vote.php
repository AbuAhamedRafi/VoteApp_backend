<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;
    protected $table = 'vote';
    protected $fillable = ['user_id', 'category_id', 'option_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function option()
    {
        return $this->belongsTo(Options::class);
    }
}
