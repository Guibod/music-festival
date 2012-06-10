<?php

require_once __DIR__.'/Symfony/Component/ClassLoader/UniversalClassLoader.php';
require_once __DIR__.'/Symfony/Component/ClassLoader/ApcUniversalClassLoader.php';

use Symfony\Component\ClassLoader\ApcUniversalClassLoader;

$loader = new ApcUniversalClassLoader('apc.prefix.');
$loader->registerNamespaces(array(
    'Symfony' => __DIR__,
    'MusicFestival' => __DIR__,
));

$loader->registerPrefix('Twig_', __DIR__.'/Twig/lib');
$loader->register(true);