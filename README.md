# Matrix unfolder and custom string reverse

## Custom string reverse

This function use recursion.

This function support mb.

#### Usage

```php
StringHelper::recursiveRevert('Hello world!'); // outputs "!dlrow olleH"
```


## Matrix unfolder

This class unfold square matrix if matrix size 2n-1.


#### Usage

```php

$matrix = [
  [1, 2, 3],
  [4, 5, 6],
  [7, 8, 9],

];

$result = (new MatrixUnfolder())->unfold($matrix); // $result = '5 4 7 8 9 6 3 2 1'
```


## Test run

```bash
composer install
php vendor/bin/phpunit
```