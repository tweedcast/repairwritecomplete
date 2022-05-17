<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class ValidateRecaptcha
{

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }



    public static function validate($key)
    {
      $url = 'https://www.google.com/recaptcha/api/siteverify?';
      $params = http_build_query(['secret' => config('app.recaptcha_key'), 'response' => $key]);
      $verify = Http::post($url . $params);

      if($verify->getStatusCode() == 200){
          $verify = $verify->body();
          $verify = json_decode($verify);
          if($verify->success){
            return true;
          }
        }

        return false;
    }



}

?>
