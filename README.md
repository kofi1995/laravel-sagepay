# Laravel 5.x Integration with SagePay

To my knowledge, Laravel lacks any SagePay Integration package. This was why I decided to write this package. The package integrates with the SagePay forms.

This Package is based on <a href="https://github.com/tolzhabayev/sagepayForm-php" target="_blank">tolzhabayev's</a> SagePay library. Credits goes to him for the development of such an awesome library for SagePay.

## Requirements

PHP 5.4 and higher. PHP7/HHVM is fully supported too.

Laravel 5 (I have not tested it on Laravel 4 but it might work)

## Installation

To install just use composer and run the command:

```$ composer require kofikwarteng/laravel-sagepay```

Alternatively, you can add ````"kofikwarteng/laravel-sagepay": "1.0.*"```` to the require block in your ```$ composer.json``` file and run ```$ composer install``` or ```$ composer update```

After, locate app.php file which can be found in the config folder of your Laravel installation. Add these two lines:

Add ```Kofikwarteng\LaravelSagepay\SagePayServiceProvider::class,``` to the list of providers

Add ```'SagePay' => Kofikwarteng\LaravelSagepay\Facade\SagePayFacade::class,``` to the list of aliases

After you are done, run this command in your root Laravel directory:

```$ php artisan vendor:publish --provider="Kofikwarteng\LaravelSagepay\SagepayServiceProvider"```

Now locate the ```sagepay.php``` file which can now be found in your config folder after running the command above. Edit the currency value and the Encryption password to your values. Make sure the Currency you enter is supported by SagePay.

SagePay has two types of Encryption Keys, the test keys and the live keys. For development, the test keys are used. The test keys, together with the Test URL, provides a sandbox where you can test their payment system with your application by using fake credit card numbers.

Here is a link to their test credit card numbers: 

http://www.sagepay.co.uk/support/12/36/test-card-details-for-your-test-transactions

NB: The link may change without notice

##Usage

To use this package in your controller, simply declare the SagePay class like this:

````use SagePay;````

You can also simply use it in the ````routes.php```` file without declaring it.

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

``return view ('pages.checkout', compact('encrypted_code' ));``

On your view, you can use this form to place a booking:
```
<form method="POST" id="SagePayForm" action="https://test.sagepay.com/gateway/service/vspform-register.vsp"> // replace test with live after you are done with development and want to receive real payments.

    <input type="hidden" name="VPSProtocol" value= "3.00">
    <input type="hidden" name="TxType" value= "PAYMENT">
    <input type="hidden" name="Vendor" value= "*VENDOR_NODE_ID"> // your Vendor Node ID goes here
    <input type="hidden" name="Crypt" value= "{{ $encrypted_code }}">
    <input type="submit" value="Pay">
</form>
```

Another way to use it is to return the encryption code as JSON, this way you can build a RestFul application based on the package. I personally used it to create a RestFul Application using AngularJS.

To check for success, sagepay attaches a url parameter called ```crypt``` to the success and failure url which is an encrypted string which can be decrypted to provide a success response. With this success response, you can mark a payment as paid in your database, send an email, etc. 

The method I personally use is to create a route with a order token parameter (the order token is just a token string I generate per order and store in the database). An example will be:

````
SagePay::setSuccessURL('https://localhost/laravel-shop/payment/' . $billing_token);
SagePay::setFailureURL('https://localhost/laravel-shop/payment/' . $billing_token);
````

Mind you, this example is created with the intention that ````laravel-shop```` is your laravel installation folder. As you can see I set the success and failure URL to be the same url. There is no need creating separate routes. We then declare our routes like this:

````
Route::any('/payment/{token}', function (Request $request, $token) {
    
    if ($request->has('crypt')) {

        $responseArray = SagePay::decode($request->get('crypt'));

        //Check status of response
        if($responseArray["Status"] === "OK"){
            //payment was successful, your success code goes  here
            //use $token to set order as paid
            //redirect user to order success page
    
            }
        elseif($responseArray["Status"] === "ABORT"){
            //user aborted the payment, your abort code goes here, payment was not successful
            //use $token to set order as aborted
            //redirect user to order aborted page
            }
        else{
            //payment was not successful for some strange reason
            //use $token to set order as failed
            //redirect user to order failed page
        }


    }
    else{
        //there was no crypt url parameter
        }
});
````





For more advanced usage, please visit <a href="https://github.com/tolzhabayev/sagepayForm-php" target="_blank">tolzhabayev's</a> GitHub page as he is the original developer of the library. You can also contact me <a href="mailto:kofi@kofikwarteng.com">HERE</a>.

I am working on various tests. They will be available soon once I'm done.

Thanks and happy coding.






