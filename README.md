# Guardian

[![Latest Version](https://img.shields.io/github/release/indigophp/guardian.svg?style=flat-square)](https://github.com/indigophp/guardian/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/indigophp/guardian/develop.svg?style=flat-square)](https://travis-ci.org/indigophp/guardian)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/indigophp/guardian.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/guardian)
[![Quality Score](https://img.shields.io/scrutinizer/g/indigophp/guardian.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/guardian)
[![HHVM Status](https://img.shields.io/hhvm/indigophp/guardian.svg?style=flat-square)](http://hhvm.h4cc.de/package/indigophp/guardian)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/guardian.svg?style=flat-square)](https://packagist.org/packages/indigophp/guardian)
[![Dependency Status](https://img.shields.io/versioneye/d/php/indigophp:guardian.svg?style=flat-square)](https://www.versioneye.com/php/indigophp:guardian)

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
use Indigo\Guardian\Service\Login;
use Indigo\Guardian\Session\Native;

$identifier = new InMemory([
	1 => [
		'username' => 'john.doe',
		'password' => 'secret',
		'name'     => 'John Doe',
	],
]);

$authenticator = new Authenticator(new Plaintext);
$session = new Native;

$service = new Login($identifier, $authenticator, $session);

// returns true to indicate success
$login->login([
	'username' => 'john.doe',
	'password' => 'secret',
]);
```

Later, when login succeeds, check for the current login:

``` php
use Indigo\Guardian\Service\Resume;

$service = new Resume($identifier, $session);

// returns true/false
$service->check();

// returns the current caller
$caller = $service->getCurrentCaller();
```

And logout at the end:

``` php
use Indigo\Guardian\Service\Logout;

$service = new Logout($session);

// returns true/false
$service->logout();
```

By design every component is switchable which makes the library superflexible and easy to integrate into any frameworks.


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
