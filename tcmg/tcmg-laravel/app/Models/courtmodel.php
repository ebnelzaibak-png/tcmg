<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courtmodel extends Model
{
    protected $guarded = [];

    // علاقة ربط الجلسة بالقضية
    public function caseModel()
    {
        return $this->belongsTo(\App\Models\Casemodel::class, 'case_id');
    }
}