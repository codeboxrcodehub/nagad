<?php

namespace Codeboxr\Nagad\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static refund($paymentRefId, $refundAmount)
 */
class NagadRefund extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'refundPayment';
    }
}
