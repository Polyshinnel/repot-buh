<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function site_info(): HasOne {
        return $this->hasOne(Site::class, 'id', 'site_id');
    }
}
