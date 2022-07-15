# Nagad payment gateway for laravel

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

