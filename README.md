Phulp Server
============

It's a third-party project that's wrapper for "php built-in server"

#### Usage

##### Install:

```bash
$ composer require --dev reisraff/phulp-server:dev-master
```

##### Coding:

```php
<?php

use Phulp\Server\Server;

$server = new Server([
    'address' => 'localhost',
    'port' => '8000',
    'router' => 'router.php',
    'path' => '/www/data',
]);

$server->fireRun();
```

## Credits

[@reisraff](http://www.twitter.com/reisraff)
