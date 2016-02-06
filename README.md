# Laravel 5.x Integration with SagePay

To my knowledge, Laravel lacks any SagePay Integration package. This was why I decided to write this package. The package integrates with the SagePay forms although I believe it can be integrated with the other versions of the SagePay payment. I will look into that.

## Installation

To install just use composer and run the command:

```$ composer require kofikwarteng/laravel-sagepay```

Alternatively, you can add it to the require block in your ```$ composer.json``` file and run ```$ composer install``` or ```$ composer update```

After, locate the app.php file which can be found in the config folder of your Laravel installation. Add these two lines:

Add Kofikwarteng\LaravelSagepay\SagePayServiceProvider::class, to the list of providers
Add 'SagePay' => Kofikwarteng\LaravelSagepay\Facade\SagePayFacade::class, to the list of aliases

After you are done, run this command in the root folder:

$ php artisan vendor:publish --provider="Kofikwarteng\LaravelSagepay\SagepayServiceProvider"

Now locate the sagepay.php file found in your config folder. Edit the currency value and the Encryption password to your values. Make sure the Currency you enter is supported by SagePay.

SagePay has two types of Encryption Keys, the test keys and the live keys. For development, the test keys are used. The test keys, together with the Test URL, provides a sandbox where you can test their payment system with your application by using fake credit card numbers.

Here is a link to their test credit card numbers:
http://www.sagepay.co.uk/support/12/36/test-card-details-for-your-test-transactions

##Usage

To use this package



