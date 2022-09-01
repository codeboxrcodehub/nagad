<?php

namespace Codeboxr\Nagad\Payment;

use Illuminate\Support\Facades\Http;
use Exception;
use Codeboxr\Nagad\Exception\NagadException;
use Codeboxr\Nagad\Exception\InvalidPublicKey;
use Codeboxr\Nagad\Exception\InvalidPrivateKey;

class Refund extends BaseApi
{
    /**
     * Payment refund
     *
     * @param $paymentRefId
     * @param float $refundAmount
     * @param string $referenceNo
     * @param string $message
     *
     * @return mixed
     * @throws NagadException
     * @throws InvalidPrivateKey
     * @throws InvalidPublicKey
     */
    public function refund($paymentRefId, $refundAmount, $referenceNo = "", $message = "Requested for refund")
    {
        $paymentDetails = (new Payment())->verify($paymentRefId);

        if (isset($paymentDetails->reason)) {
            throw new NagadException($paymentDetails->message);
        }

        if (empty($referenceNo)) {
            $referenceNo = $this->getRandomString(10);
        }

        $sensitiveOrderData = [
            'merchantId'          => config("nagad.merchant_id"),
            "originalRequestDate" => date("Ymd"),
            'originalAmount'      => $paymentDetails->amount,
            'cancelAmount'        => $refundAmount,
            'referenceNo'         => $referenceNo,
            'referenceMessage'    => $message,
        ];

        $response = Http::withHeaders($this->headers())
            ->post($this->baseUrl . "purchase/cancel?paymentRefId={$paymentDetails->paymentRefId}&orderId={$paymentDetails->orderId}", [
                "sensitiveDataCancelRequest" => $this->encryptWithPublicKey(json_encode($sensitiveOrderData)),
                "signature"                  => $this->signatureGenerate(json_encode($sensitiveOrderData))
            ]);

        $responseData = json_decode($response->body());
        if (isset($responseData->reason)) {
            throw new NagadException($responseData->message);
        }

        return json_decode($this->decryptDataPrivateKey($responseData->sensitiveData));
    }
}
