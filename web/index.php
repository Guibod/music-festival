<?php

require_once __DIR__.'/../lib/bootstrap.php';

$persons = \MusicFestival\Config::getInstance()->getPersons();

echo \MusicFestival\Config::getInstance()->getTwig()->render('index.twig', array('persons' => $persons));


