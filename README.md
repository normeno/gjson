# Gjson

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Gjson is a PHP library to work under the Google Json Style Guide standard.


## Install

Via Composer

``` bash
$ composer require normeno/gjson
```

## Usage

### Remove Empties
``` php
$format = new Format();
echo $format->removeEmpty(['foo' => 'bar', 'null' => null, 'empty' => '', 'zero' => 0]);
```

### Set RFC3339
``` php
$format = new Format();
echo $format->setRfc3339('1989-10-05');
```

### Convert Snake to Camel
``` php
$format = new Format();
echo $format->convertSnakeToCamel([
    'laTaM_cOuNtRy' => 'Chile',
    'latam_REGION'  => 'Metropolitana',
    'LATAM_city'    => 'Santiago'
]);
```
### Set ISO-6793
``` php
$format = new Format();
echo $format->setIso6709(['+40.6894', '-074.0447']);
```

### Error Response
``` php
$response = new Response();
echo $this->response->error(404, 'File Not Found');
```

### Success Response
``` php
$response = new Response();
$data = [
    'items' => [
        'company'   => 'Google',
        'website'   => 'https://www.google.com/'
    ]
];

echo $this->response->success($data);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email ni.ormeno@gmail.com instead of using the issue tracker.

## Credits

- [normeno][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/normeno/gjson.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://travis-ci.org/normeno/gjson.svg?branch=master
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/normeno/gjson.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/normeno/gjson.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/normeno/gjson.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/normeno/gjson#lastest
[link-travis]: https://travis-ci.org/normeno/gjson
[link-scrutinizer]: https://scrutinizer-ci.com/g/normeno/gjson/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/normeno/gjson
[link-downloads]: https://packagist.org/packages/normeno/gjson
[link-author]: https://github.com/normeno
[link-contributors]: ../../contributors
