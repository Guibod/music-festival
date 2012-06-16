<?php

require_once __DIR__.'/../lib/bootstrap.php';

$config  = \MusicFestival\Config::getInstance();

if(!isset($_GET['who'])) {
  $persons = $config->getPersons();
} else {
  $persons = array( \MusicFestival\Person::fromName($_GET['who']));
}


echo $config->getTwig()->render('tagcloud.twig', array('who' => @$_GET['who'], 'tags' => \MusicFestival\TagCloud::fromPersonList($persons)));;