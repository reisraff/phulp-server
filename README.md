Phulp Server
============

It's a third-party project that's wrapper for "php built-in server"

#### Usage

##### Install:

```bash
$ composer require --dev reisraff/phulp-server
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

##### Using with [PHULP](https://github.com/reisraff/phulp).

```php
<?php

use Phulp\Server\Server;

$phulp->task('serve', function ($phulp) use ($config) {
    $server = new Server(
        [
            'address' => 'localhost',
            'port' => '8000',
            'router' => 'router.php',
            'path' => $config['project_path'],
        ],
        $phulp->getLoop()
    );
});

```

## Credits

[@reisraff](http://www.twitter.com/reisraff)
