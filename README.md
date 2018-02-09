# Sekkr

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Sekkr is a package for array manipulation.

It is based on the work of Riku Särkinen (@adbario) at [adbario/php-dot-notation](https://github.com/adbario/php-dot-notation).

## Install

Via Composer

``` bash
$ composer require NorseBlue/Sekkr
```

## Usage

``` php
$arr = new NorseBlue\Sekkr\Arr();
$arr->set('config.vcs.repo.url', 'https://github.com/NorseBlue/Sekkr.git');
echo $arr->get('config.vcs.repo.url');

// Output:
// https://github.com/NorseBlue/Sekkr.git
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CODE_OF_CONDUCT](.github/CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email `dev@norse.blue` instead of using the issue tracker.

## Credits

- [NorseBlue][link-author]
- [Axel Pardemann](https://github.com/axelitus)
- [Riku Särkinen](https://github.com/adbario)
- [All Contributors](.github/CONTRIBUTORS.md)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/norse-blue/sekkr.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/NorseBlue/Sekkr/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/NorseBlue/Sekkr.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/NorseBlue/Sekkr.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/norse-blue/sekkr.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/norse-blue/sekkr
[link-travis]: https://travis-ci.org/NorseBlue/Sekkr
[link-scrutinizer]: https://scrutinizer-ci.com/g/NorseBlue/Sekkr/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/NorseBlue/Sekkr
[link-downloads]: https://packagist.org/packages/norse-blue/sekkr
[link-author]: https://github.com/NorseBlue
