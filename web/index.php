<?php

require_once __DIR__.'/../lib/bootstrap.php';

$persons = \MusicFestival\Config::read(\MUSICFESTIVAL_DIR."/config/playlists/sample.yml");

echo \MusicFestival\Config::getInstance()->getTwig()->render('index.twig', array('persons' => $persons));


