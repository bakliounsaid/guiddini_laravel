<?php

namespace GuiddiniLaravel;

use Illuminate\Support\Facades\Validator;
use Exception;
use GuiddiniLaravel\Models\Epayment;
use Carbon\Carbon;


class GuiddiniPayment
{
    public function initiateTransaction($license, $orderId, $total, $returnUrl, $language)
    {
        $rules = [
            'license' => 'required|string',
            'orderId' => 'required|numeric',
            'total' => 'required|numeric',
            'language' => 'nullable|in:en,ar,fr',
            'returnUrl' => 'required|url',
        ];
        // Validate the parameters
        $validator = Validator::make([
            'license' => $license,
            'language' => $language,
            'orderId' => $orderId,
            'total' => $total,
            'returnUrl' => $returnUrl,
        ], $rules);

        // Check if validation fails
        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            throw new GuiddiniPaymentException("Error validating transaction: " . $errorMessage);
        }

        try {
            $epayment = Epayment::create([
                'order_id' => $orderId,
                'status' => '0',
            ]);
            $redirectUrl = "https://test.satim.guiddini.dz/SATIM-WFGWX-YVC9B-4J6C9/" . $license . "/cib.php"
                . "?order_id=$epayment->id&returnUrl=$returnUrl&total=$total&language=$language";
            // Handle response, e.g., redirect user to SATIM payment page
            return redirect()->away($redirectUrl);
        } catch (Exception $e) {
            // Handle API request errors
            throw new GuiddiniPaymentException("Error initiating transaction: " . $e->getMessage());
        }
    }

    public function validateTransaction($license, $orderNumber, $gatewayOrderId, $total, $returnUrl)
    {
        try {
            $redirectUrl = "https://test.satim.guiddini.dz/SATIM-WFGWX-YVC9B-4J6C9/" . $license . "/returnCib.php"
                . "?gatewayOrderId=$gatewayOrderId&returnUrl=$returnUrl&orderNumber=$orderNumber&total=$total";
            return redirect()->away($redirectUrl);
        } catch (Exception $e) {
            // Handle API request errors
            throw new GuiddiniPaymentException("Error validating transaction: " . $e->getMessage());
        }
    }
    public function checkResult($request)
    {
      try {
         $current_time = Carbon::now();
         $orderNumber =    $request->input('orderNumber');

        $epayment = Epayment::find($orderNumber);

        $current_time_date_expiration = Carbon::now();


        // La modification s'applique une seule fois. En cas de réinitialisation de la page, aucun changement n'est observé
         if (empty($epayment->bool)) {

            $epayment->update([
                'order_id_satim' => $request->input('orderId'),
                'bool' => $request->input('bool'),
                'error_code' => $request->input('ErrorCode'),
                'message_return' => $request->input('MessageReturn'),
                'code' => $request->input('code'),
                'total' => $request->input('total'),
                'date_transaction' => $current_time,
            ]);

            if ($epayment->error_code == 0) {
                $epayment->update([
                    'status' => 1,
                    'date_expiration' => $current_time_date_expiration
                ]);
               return $epayment; 
            }
        }
        return false;
    } catch (Exception $e) {
       return false ;
    }
    }
}
