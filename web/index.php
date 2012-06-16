<?php

require_once __DIR__.'/../lib/bootstrap.php';

$config  = \MusicFestival\Config::getInstance();
$persons = $config->getPersons();

if(!$config->getSetting('playlist','open')) {
  throw new Exception("Playlist is not yet opened to public.");
}

echo $config->getTwig()->render('index.twig', array('persons' => $persons));


