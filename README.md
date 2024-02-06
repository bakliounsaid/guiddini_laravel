# guiddini_Laravel

GuiddiniLaravel is a Laravel package designed to simplify the integration of the Guiddini payment API into your Laravel applications.

## Installation

You can install the GuiddiniLaravel package via Composer. Run the following command in your terminal:

```bash
composer require vendor/guiddini-laravel
```
## Usage
### Initiating a Transaction
To initiate a transaction with the Guiddini payment API, you can use the initiateTransaction() method provided by the GuiddiniPayment class:

use GuiddiniLaravel\GuiddiniPayment;
use GuiddiniLaravel\Exceptions\GuiddiniPaymentException;

try {
    $guiddiniPayment = new GuiddiniPayment();
    $response = $guiddiniPayment->initiateTransaction($license, $orderId, $total, $returnUrl, $language);
    // Handle the response, e.g., redirect user to the payment page
} catch (GuiddiniPaymentException $e) {
    // Handle Guiddini payment exceptions
    echo $e->getMessage();
    // Optionally, retrieve and handle additional details
    echo $e->getStatusCode();
    echo $e->getMessageReturn();
}

### Validating a Transaction
To validate a transaction with the Guiddini payment API, you can use the validateTransaction() method provided by the GuiddiniPayment class:

use GuiddiniLaravel\GuiddiniPayment;
use GuiddiniLaravel\Exceptions\GuiddiniPaymentException;

try {
    $guiddiniPayment = new GuiddiniPayment();
    $response = $guiddiniPayment->validateTransaction($license, $orderNumber, $orderId, $total, $returnUrl);
    // Handle the response, e.g., process the payment confirmation
} catch (GuiddiniPaymentException $e) {
    // Handle Guiddini payment exceptions
    echo $e->getMessage();
    // Optionally, retrieve and handle additional details
    echo $e->getStatusCode();
    echo $e->getMessageReturn();
}
## License
This package is open-sourced software licensed under the MIT license.
