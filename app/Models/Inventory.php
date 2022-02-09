<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inventory extends Model
{
    use HasFactory;
    public function getColor()
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }
    public function getSize()
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }
}
