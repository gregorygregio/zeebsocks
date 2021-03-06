<?php

namespace App;

use App\Entities\Address;
use App\Entities\Order;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Services\BrazilianMasks;
use App\Utils\Utils;

class User extends Authenticatable
{
    use Notifiable;


    public function address(){
        return $this->hasOne(Address::class);
    }


    public function orders(){
        return $this->hasMany(Order::class);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'facebook_id'
    ];


    protected $guarded = [
        'permission'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = Utils::removeFormatations($value);
    }


    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = Utils::removeFormatations($value);
    }

    public function getCpfAttribute($value)
    {
        return BrazilianMasks::applyCPFMask($value);
    }

    public function getPhoneAttribute($value)
    {
        $digits = strlen($value);
        if($digits === 11)
            return BrazilianMasks::applyCellPhoneMask($value);
        elseif($digits === 10)
            return BrazilianMasks::applyPhoneMask($value);
    }


    public function getBirthAttribute($value) {
        if(is_null($value))
            return "";
        $mutable = Carbon::createFromFormat('Y-m-d', $value);
        return $mutable->format("d/m/Y");

    }

    public function isAdmin() {
        return $this->permission === 1;
    }

    public function getFirstName(){
      $splitedName =explode(" ", $this->name);
      return array_shift($splitedName);
    }

    public function isEmailAlreadyRegistered() {
        $doesExist = self::where("email", $this->email)->get();
        return (count($doesExist) > 0);
    }

    public function isCPFAlreadyRegistered() {
        $doesExist = self::where("cpf", Utils::removeFormatations($this->cpf))->get();
        return (count($doesExist) > 0);
    }

}
