<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SocialUser extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];

    public function scopeSocialId($query, $id) {
      return $query->where('social_id', $id);
   }

   public static function getUserIfExists($socialId){
      $existingUser = SocialUser::socialId($socialId)->first();
      if(is_null($existingUser))
        return false;

      if(is_null($existingUser->user_id))
        return false;

      return User::find($existingUser->user_id);
   }
}
