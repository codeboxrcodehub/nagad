<?php

namespace Codeboxr\Nagad\Controllers;

use Illuminate\Http\Request;
use Codeboxr\Nagad\Facade\NagadPayment;

class NagadPaymentController
{
    public function callback(Request $request)
    {
        if (!$request->status && !$request->order_id) {
            return response()->json([
                "error" => "Not found any status"
            ], 500);
        }

        if (config("nagad.response_type") == "json") {
            return response()->json($request->all());
        }

        $verify = NagadPayment::verify($request->payment_ref_id);

        if ($verify->status == "Success") {
            return redirect("/nagad-payment/{$verify->orderId}/success");
        } else {
            return redirect("/nagad-payment/{$verify->orderId}/fail");
        }

    }

    public function success($transId)
    {
        return view("nagad::success", compact('transId'));
    }

    public function fail($transId)
    {
        return view("nagad::failed", compact('transId'));
    }
}
