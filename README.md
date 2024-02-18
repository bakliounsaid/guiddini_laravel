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
```php
use GuiddiniLaravel\GuiddiniPayment;

    $guiddiniPayment = new GuiddiniPayment();
    $guiddiniPayment->initiateTransaction($license, $orderId, $total, $returnUrl, $language);
    //redirect user to the payment page

```
### Validating a Transaction
To validate a transaction with the Guiddini payment API, you can use the validateTransaction() method provided by the GuiddiniPayment class:
```php
use GuiddiniLaravel\GuiddiniPayment;
    $guiddiniPayment = new GuiddiniPayment();
    $response = $guiddiniPayment->validateTransaction($license, $orderNumber, $orderId, $total, $returnUrl);
    // process the payment confirmation
```
### Check Transaction
```php
$guiddiniPayment = new GuiddiniPayment();
$epayment =  $guiddiniPayment->checkResult(request());
if($epayment->error_code == 0)
{
  //success transaction 
} 
else
{
  //transaction failed 
}
## License
This package is open-sourced software licensed under the MIT license.
