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

  if(\move_uploaded_file($_FILES['mySample']['tmp_name'], $target)) {
    $persons = array($id => \MusicFestival\Person::fromYaml($target));
    echo $config->getTwig()->render('index.twig', array('persons' => $persons));
    exit;
  }
}
echo $config->getTwig()->render('my.twig', array('sample' => $sample));