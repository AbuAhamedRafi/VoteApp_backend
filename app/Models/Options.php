<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Options extends Model
{
    use HasFactory;
    protected $table = 'options';
    protected $fillable = [
        'category_id',
        'name',
    ];
}
