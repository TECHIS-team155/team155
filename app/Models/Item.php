<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'detail'
    ];

    /**
     * 種別の取得
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
