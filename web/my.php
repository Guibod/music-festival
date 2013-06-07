<?php

require_once __DIR__.'/../lib/bootstrap.php';

$config  = \MusicFestival\Config::getInstance();

$sample  = \file_get_contents(\MUSICFESTIVAL_DIR.\DIRECTORY_SEPARATOR.'config/sample/sample.yml');

if(isset($_FILES['mySample'])) {
  $id = pathinfo ( $_FILES['mySample']['tmp_name'], PATHINFO_FILENAME );
  $target = \MUSICFESTIVAL_DIR.\DIRECTORY_SEPARATOR."cache/yml/$id.yml";

  if(!\file_exists(\pathinfo($target, \PATHINFO_DIRNAME))) {
    \mkdir(\pathinfo($target, \PATHINFO_DIRNAME), 0777, true);
  }

  try {
    $persons = array($id => \MusicFestival\Person::fromYaml($_FILES['mySample']['tmp_name']));
    echo $config->getTwig()->render('index.twig', array('persons' => $persons));
  } catch (Symfony\Component\Yaml\Exception\ParseException $e) {
    echo $e->getMessage();
  }
  exit;

}
echo $config->getTwig()->render('my.twig', array('sample' => $sample));