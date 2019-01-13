<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Services\BrazilianMasks;

class Address extends Model
{
    protected $table = "address";

    protected $guarded = [ "id", "user_id" ];


    public function getZipcodeAttribute($value)
    {
        return BrazilianMasks::applyCEPMask($value);
    }
}
