<?php

require_once __DIR__.'/../lib/bootstrap.php';

$config  = \MusicFestival\Config::getInstance();
$persons = $config->getPersons(@$_GET['playlist']);

if(!$config->getSetting('playlist','open')) {
  throw new Exception("Playlist is not yet opened to public.");
}

echo $config->getTwig()->render('playlist.twig', array(
  'title' =>  $config->getSetting('site','title'),
  'playlistId' => @$_GET['playlist'],
  'persons' => $persons)
);


