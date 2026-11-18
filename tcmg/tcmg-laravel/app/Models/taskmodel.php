<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class taskmodel extends Model
{
    protected $guarded = [];

    // علاقة ربط المهمة بالعميل
    public function clint()
    {
        return $this->belongsTo(\App\Models\Clint::class, 'clint_id');
    }
}
