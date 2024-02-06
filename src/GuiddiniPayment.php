<?php
namespace GuiddiniLaravel;

use Illuminate\Support\Facades\Validator;
use Exception;


class GuiddiniPayment
{
    public function initiateTransaction($license, $orderId, $total, $returnUrl, $language)
    {
        $rules = [
            'license' => 'required|string',
            'orderId' => 'required|numeric',
            'total' => 'required|numeric',
            'language'=>'nullable|in:en,ar,fr',
            'returnUrl' => 'required|url',
        ];

        // Validate the parameters
        $validator = Validator::make([
            'license' => $license,
            'orderNumber' => $orderId,
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
            $redirectUrl = "https://test.satim.guiddini.dz/SATIM-WFGWX-YVC9B-4J6C9/".$license ."/cib.php"
            . "?order_id=$orderId&returnUrl=$returnUrl&total=$total&language=$language";
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
             $redirectUrl = "https://test.satim.guiddini.dz/SATIM-WFGWX-YVC9B-4J6C9/".$license."/returnCib.php"
                 . "?gatewayOrderId=$gatewayOrderId&returnUrl=$returnUrl&orderNumber=$orderNumber&total=$total";
    
             return redirect()->away($redirectUrl);
    
        } catch (Exception $e) {
            // Handle API request errors
            throw new GuiddiniPaymentException("Error validating transaction: " . $e->getMessage());
        }
    }
}

