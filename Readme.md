# Nagad payment gateway for laravel

[![Downloads](https://img.shields.io/packagist/dt/codeboxr/nagad)](https://packagist.org/packages/codeboxr/nagad)
[![Starts](https://img.shields.io/packagist/stars/codeboxr/nagad)](https://packagist.org/packages/codeboxr/nagad)


## Requirements

- PHP >=7.2
- Laravel >= 6

## Installation

```bash
composer require codeboxr/nagad
```

### vendor publish (config)
```bash
php artisan vendor:publish --provider="Codeboxr\Nagad\NagadServiceProvider"
```

After publish config file setup your credential. you can see this in your config directory nagad.php file


## Usage

### 1. Create Payment

```
use Codeboxr\Nagad\Payment\Payment;

(new Payment)->create(2, "dwAbcd343223wDweg")
```
or

```
use Codeboxr\Nagad\Facade\NagadPayment;

NagadPayment::create(2, 'abc1DefS34');
```
### 2. Verify Payment

```
use Codeboxr\Nagad\Payment\Payment;

(new Payment)->verify($paymentRefId) // $paymentRefId which you will find callback URL request parameter
```
or

```
use Codeboxr\Nagad\Facade\NagadPayment;

NagadPayment::verify($paymentRefId);
```

## Contributing

Contributions to the Nagad package are welcome. Please note the following guidelines before submitting your pull request.

- Follow [PSR-4](http://www.php-fig.org/psr/psr-4/) coding standards.
- Read Nagad API documentations first

## License

Nagad is licensed under the [MIT License](http://opensource.org/licenses/MIT).

Copyright 2022 [Codeboxr](https://codeboxr.com)
