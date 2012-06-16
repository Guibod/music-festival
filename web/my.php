<?php

require_once __DIR__.'/../lib/bootstrap.php';

$config  = \MusicFestival\Config::getInstance();

if($config->getSetting('playlist','open')) {
  header('Location: index.php');
  exit;
}

$person = \MusicFestival\Person::fromName($_GET['name']);
if(@$_GET['secret'] != $person->getSecret()) {
  throw new Exception("Invalid secret key.");
}

echo $config->getTwig()->render('index.twig', array('persons' => array($person), 'showYaml' => true));


