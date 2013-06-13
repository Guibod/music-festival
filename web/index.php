<?php

require_once __DIR__.'/../lib/bootstrap.php';

$config  = \MusicFestival\Config::getInstance();
$playlists = $config->getPlaylists();

echo $config->getTwig()->render('index.twig', array('playlists' => $playlists));