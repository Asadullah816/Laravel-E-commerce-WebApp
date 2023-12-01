<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Comment extends Model
{
    use HasFactory;
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
