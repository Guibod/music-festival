<?php

require_once '../lib/bootstrap.php';

$twig = new Twig_Environment(new Twig_Loader_Filesystem(__DIR__.'/../web'));

$persons = \MusicFestival\Config::read(__DIR__."/../config/sample.yml");

echo $twig->render('index.twig', array('persons' => $persons));


