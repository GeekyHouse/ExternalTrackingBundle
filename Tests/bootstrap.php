<?php
// Tests/bootstrap.php
$loader = @include __DIR__ . '/../vendor/autoload.php';
if (!$loader) {
    die(<<<'EOT'
You must set up the project dependencies, run the following commands:
wget http://getcomposer.org/composer.phar
php composer.phar install
EOT
    );
}
\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

spl_autoload_register(function($class) {
    if (0 === strpos($class, 'GeekyHouse\\ExternalTrackingBundle\\')) {
        $path = __DIR__.'/../'.implode('/', array_slice(explode('\\', $class), 2)).'.php';
        if (!stream_resolve_include_path($path)) {
            return false;
        }
        require_once $path;
        return true;
    }
});
/*
if (!@include __DIR__ . './../vendor/autoload.php') {
    die("You must set up the project dependencies, running the following commands:
wget http://getcomposer.org/composer.phar
php composer.phar install
");
}

spl_autoload_register(function($class) {
    if (0 === strpos($class, 'GeekyHouse\ExternalTrackingBundle\\') &&
        file_exists($file = __DIR__ . '/../' . implode('/', array_slice(explode('\\', $class), 3)) . '.php')
    ) {
        require_once $file;
    }
});
*/