<?php

namespace App\Services;

use App\Models\Reciept;
use Illuminate\Support\Collection;

class RecieptService
{
    public function getReciepts(): Collection
    {
        return Reciept::all();
    }
}
