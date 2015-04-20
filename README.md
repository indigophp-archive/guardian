# Guardian

[![Latest Version](https://img.shields.io/github/release/indigophp/guardian.svg?style=flat-square)](https://github.com/indigophp/guardian/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/indigophp/guardian/develop.svg?style=flat-square)](https://travis-ci.org/indigophp/guardian)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/indigophp/guardian.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/guardian)
[![Quality Score](https://img.shields.io/scrutinizer/g/indigophp/guardian.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/guardian)
[![HHVM Status](https://img.shields.io/hhvm/indigophp/guardian.svg?style=flat-square)](http://hhvm.h4cc.de/package/indigophp/guardian)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/guardian.svg?style=flat-square)](https://packagist.org/packages/indigophp/guardian)

**Simple and flexible authentication framework.**


## Install

Via Composer

``` bash
$ composer require indigophp/guardian
```

## Usage

This library provides an easy way to authenticate any entity with OR without persisting and calling it "login".

A simple login example:

``` php
use Indigo\Guardian\Identifier\InMemory;
use Indigo\Guardian\Authenticator\UserPassword;
use Indigo\Guardian\Hasher\Plaintext;
use Indigo\Guardian\SessionAuth;
use Indigo\Guardian\Session\Native;

$identifier = new InMemory([
    1 => [
        'username' => 'john.doe',
        'password' => 'secret',
        'name'     => 'John Doe',
    ],
]);

$authenticator = new UserPassword(new Plaintext);
$session = new Native;

$auth = new SessionAuth($identifier, $authenticator, $session);

// returns true to indicate success
$auth->login([
    'username' => 'john.doe',
    'password' => 'secret',
]);
```

Later, when login succeeds, check for the current login:

``` php
// returns true/false
$auth->check();

// returns the current caller
$caller = $auth->getCurrentCaller();
```

And logout at the end:

``` php
// returns true/false
$auth->logout();
```


### API Authentication

Since Guardian is an authentication library, you can easily use it to authenticate API requests without persistence. To achieve this, see the following simple authentication service:


``` php
use Indigo\Guardian\Identifier\InMemory;
use Indigo\Guardian\Authenticator\UserPassword;
use Indigo\Guardian\Hasher\Plaintext;
use Indigo\Guardian\RequestAuth;

$identifier = new InMemory([
    1 => [
        'username' => 'john.doe',
        'password' => 'secret',
        'name'     => 'John Doe',
    ],
]);

$authenticator = new UserPassword(new Plaintext);

$auth = new RequestAuth($identifier, $authenticator);

$subject = [
    'username' => 'john.doe',
    'password' => 'secret',
];

// returns true to indicate success
$auth->authenticate($subject);

// returns the caller object if identify succeeds
$caller = $auth->authenticateAndReturn($subject);
```


## Testing

``` bash
$ phpspec run
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/guardian/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
