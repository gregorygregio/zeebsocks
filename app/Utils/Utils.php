<?php

namespace App\Utils;

class Utils {
  public static function removeFormatations($val) {
    return preg_replace('/[^0-9]/s', '', $val);
  }

}
