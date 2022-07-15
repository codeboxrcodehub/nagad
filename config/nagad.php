<?php

return [
    "sandbox"         => env("NAGAD_SANDBOX", true),
    "merchant_id"     => env("NAGAD_MERCHANT_ID", ""),
    "merchant_number" => env("NAGAD_MERCHANT_NUMBER", ""),
    "public_key"      => env("NAGAD_PUBLIC_KEY", ""),
    "private_key"     => env("NAGAD_PRIVATE_KEY", ""),
    'timezone'        => 'Asia/Dhaka',

    /*
      |--------------------------------------------------------------------------
      | Default callback url
      |--------------------------------------------------------------------------
      |
      | This option controls the nagad callback url
      | By default, it will redirect to "http://127.0.0.1:8000/nagad/callback/nagad/callback"
      | you may change this url any time.
      */
    "callback_url"    => env("NAGAD_CALLBACK_URL", "http://127.0.0.1:8000/nagad/callback"),

    /*
      |--------------------------------------------------------------------------
      | Default Response Type
      |--------------------------------------------------------------------------
      |
      | This option controls the response type callback
      | By default, it will return json data
      | you may specify any of the other wonderful options provided here.
      |
      | Supported: "json", "html",
      |
      */
    "response_type"   => "json" // response type json/html
];
