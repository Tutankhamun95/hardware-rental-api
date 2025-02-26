<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = ['action', 'loggable_id', 'loggable_type', 'old_data', 'new_data'];

    public function loggable()
    {
        return $this->morphTo();
    }
}
