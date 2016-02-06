# Laravel 5.x Integration with SagePay

To my knowledge, Laravel lacks any SagePay Integration package. This was why I decided to write this package. The package integrates with the SagePay forms although I believe it can be integrated with the other versions of the SagePay payment. I will look into that.

This Package is based on [tolzhabayev's](https://github.com/tolzhabayev/sagepayForm-php) SagePay library. Credits goes to him for the development of such an awesome library for SagePay.

## Installation

To install just use composer and run the command:

```$ composer require kofikwarteng/laravel-sagepay```

Alternatively, you can add it to the require block in your ```$ composer.json``` file and run ```$ composer install``` or ```$ composer update```

After, locate the app.php file which can be found in the config folder of your Laravel installation. Add these two lines:

Add ```Kofikwarteng\LaravelSagepay\SagePayServiceProvider::class,``` to the list of providers

Add ```'SagePay' => Kofikwarteng\LaravelSagepay\Facade\SagePayFacade::class,``` to the list of aliases

After you are done, run this command in the root folder:

```$ php artisan vendor:publish --provider="Kofikwarteng\LaravelSagepay\SagepayServiceProvider"```

Now locate the ```sagepay.php``` file found in your config folder. Edit the currency value and the Encryption password to your values. Make sure the Currency you enter is supported by SagePay.

SagePay has two types of Encryption Keys, the test keys and the live keys. For development, the test keys are used. The test keys, together with the Test URL, provides a sandbox where you can test their payment system with your application by using fake credit card numbers.

Here is a link to their test credit card numbers:
http://www.sagepay.co.uk/support/12/36/test-card-details-for-your-test-transactions

NB: The link may change without notice

##Usage

To use this package, simply declare the SagePay class like this;

use SagePay;

You can then use the example below to create a simple payment:
```
SagePay::setAmount('100');
SagePay::setDescription('Lorem ipsum');
SagePay::setBillingSurname('Mustermann');
SagePay::setBillingFirstnames('Max');
SagePay::setBillingCity('Cologne');
SagePay::setBillingPostCode('50650');
SagePay::setBillingAddress1('Bahnhofstr. 1');
SagePay::setBillingCountry('de');
SagePay::setDeliverySameAsBilling();
SagePay::setSuccessURL('https://www.yoururl.com/success.php');
SagePay::setFailureURL('https://www.yoururl.org/fail.php');
```
I believe this is very straight forward and easy to use. What the library does is to get the information of your payment and encrypt it into a string that only SagePay can understand and decrypt.

To output the encrypted string simply call this method:

```$encrypted_code = SagePay::getCrypt();```

To submit the encryption code to SagePay, you can do something like this using blade:

``return view ('pages.checkout', compact($encrypted_code ));``

On your view, you can use this form to place a booking:
```
<form method="POST" id="SagePayForm" action="*https://test.sagepay.com/gateway/service/vspform-register.vsp*"> // replace test with live after you are done with development and want to receive real payments.

    <input type="hidden" name="VPSProtocol" value= "3.00">
    <input type="hidden" name="TxType" value= "PAYMENT">
    <input type="hidden" name="Vendor" value= "*VENDOR_NODE_ID"> // your Vendor Node ID goes here
    <input type="hidden" name="Crypt" value= "{{ $encrypted_code }}">
    <input type="submit" value="Pay">
</form>
```

Another way to use it is to return the encryption code as JSON, this way you can build a RestFul application based on the package. I personally used it to create a RestFul Application using AngularJS.

For more advanced usage, please visit [tolzhabayev's](https://github.com/tolzhabayev/sagepayForm-php) GitHub page as he is the original developer of the library. You can also contact me [HERE](mailto:kofi@kofikwarteng.com).

Thanks and happy coding.






