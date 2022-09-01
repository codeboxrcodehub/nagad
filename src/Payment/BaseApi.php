<?php

namespace Codeboxr\Nagad\Payment;

use Codeboxr\Nagad\Traits\Helpers;

class BaseApi
{
    use Helpers;

    /**
     * @var string $baseUrl
     */
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl();
    }

    /**
     * Nagad Base Url
     * if sandbox is true it will be sandbox url otherwise it is host url
     */
    private function baseUrl()
    {
        if (config("nagad.sandbox") == true) {
            $this->baseUrl = 'http://sandbox.mynagad.com:10080/remote-payment-gateway-1.0/api/dfs/';
        } else {
            $this->baseUrl = 'https://api.mynagad.com/api/dfs/';
        }
    }

    /**
     * Nagad Request Headers
     *
     * @return array
     */
    protected function headers()
    {
        return [
            "Content-Type"     => "application/json",
            "X-KM-IP-V4"       => $this->getIp(),
            "X-KM-Api-Version" => "v-0.2.0",
            "X-KM-Client-Type" => "PC_WEB"
        ];
    }
}
