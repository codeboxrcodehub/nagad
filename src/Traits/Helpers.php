<?php

namespace Codeboxr\Nagad\Traits;

use Carbon\Carbon;
use Codeboxr\Nagad\Exception\InvalidPublicKey;
use Codeboxr\Nagad\Exception\InvalidPrivateKey;

trait Helpers
{
    /**
     * @return string|null
     */
    public function getIp()
    {
        return request()->ip();
    }

    /**
     * @param int $length
     *
     * @return string
     */
    public function getRandomString($length = 45)
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param string $invoice
     *
     * @return array
     */
    public function getSensitiveData(string $invoice)
    {
        return [
            'merchantId' => config("nagad.merchant_id"),
            'datetime'   => Carbon::now(config("nagad.timezone"))->format("YmdHis"),
            'orderId'    => $invoice,
            'challenge'  => $this->getRandomString()
        ];
    }

    /**
     * @param string $data
     *
     * @return string
     * @throws InvalidPublicKey
     */
    public function encryptWithPublicKey(string $data)
    {
        $publicKey   = "-----BEGIN PUBLIC KEY-----\n" . config('nagad.public_key') . "\n-----END PUBLIC KEY-----";
        $keyResource = openssl_get_publickey($publicKey);
        $status      = openssl_public_encrypt($data, $cryptoText, $keyResource);
        if ($status) {
            return base64_encode($cryptoText);
        } else {
            throw new InvalidPublicKey('Invalid Public key');
        }
    }

    /**
     * @param string $data
     *
     * @return mixed
     */
    public static function decryptDataPrivateKey(string $data)
    {
        $private_key = "-----BEGIN RSA PRIVATE KEY-----\n" . config('nagad.private_key') . "\n-----END RSA PRIVATE KEY-----";
        openssl_private_decrypt(base64_decode($data), $plain_text, $private_key);
        return $plain_text;
    }

    /**
     * @param string $data
     *
     * @return string
     * @throws InvalidPrivateKey
     */
    public function signatureGenerate(string $data)
    {
        $private_key = "-----BEGIN RSA PRIVATE KEY-----\n" . config("nagad.private_key") . "\n-----END RSA PRIVATE KEY-----";
        $status      = openssl_sign($data, $signature, $private_key, OPENSSL_ALGO_SHA256);
        if ($status) {
            return base64_encode($signature);
        } else {
            throw new InvalidPrivateKey('Invalid private key');
        }

    }
}
