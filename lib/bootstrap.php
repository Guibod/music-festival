<?php

require_once __DIR__.'/Symfony/Component/ClassLoader/UniversalClassLoader.php';
if(\function_exists('apc_clear_cache')) {
  require_once __DIR__.'/Symfony/Component/ClassLoader/ApcUniversalClassLoader.php';
  $loader = new Symfony\Component\ClassLoader\ApcUniversalClassLoader('apc.prefix.');
} else {
  $loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
}



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