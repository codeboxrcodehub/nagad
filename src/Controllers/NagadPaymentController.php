<?php

namespace Codeboxr\Nagad\Controllers;

use Illuminate\Http\Request;

class NagadPaymentController
{
    public function callback(Request $request)
    {
        if (config("nagad.response_type") == "html") {
            if ($request->status == "Success") {
                return redirect("/nagad-payment/success");
            } else {
                return redirect("/nagad-payment/fail");
            }
        }

        return $request->all();
    }

    public function success()
    {
        return view("nagad::success");
    }

    public function fail()
    {
        return view("nagad::failed");
    }
}
