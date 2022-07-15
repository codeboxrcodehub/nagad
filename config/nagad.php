<?php

return [
    "sandbox"         => env("NAGAD_SANDBOX", true),
    "merchant_id"     => env("NAGAD_MERCHANT_ID", ""),
    "merchant_number" => env("NAGAD_MERCHANT_NUMBER", ""),
    "callback_url"    => env("NAGAD_CALLBACK_URL"),
    "public_key"      => env("NAGAD_PUBLIC_KEY", ""),
    "private_key"     => env("NAGAD_PRIVATE_KEY", ""),
    'timezone'        => 'Asia/Dhaka'
];
