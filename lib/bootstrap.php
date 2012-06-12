<?php

require_once __DIR__.'/Symfony/Component/ClassLoader/UniversalClassLoader.php';
require_once __DIR__.'/Symfony/Component/ClassLoader/ApcUniversalClassLoader.php';

use Symfony\Component\ClassLoader\ApcUniversalClassLoader;

$loader = new ApcUniversalClassLoader('apc.prefix.');

/*require_once __DIR__.'/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader('apc.prefix.');*/
$loader->registerNamespaces(array(
    'Symfony' => __DIR__,
    'MusicFestival' => __DIR__,
    'Lastfm' => __DIR__.'/LastFm/src',
));

$loader->registerPrefixes(array(
    'Twig_' => __DIR__.'/Twig/lib',
    'Cache_' => __DIR__.'/Cache',
));
$loader->register();

define('MUSICFESTIVAL_DIR', realpath(__DIR__.'/..'));

