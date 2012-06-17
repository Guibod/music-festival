<?php

require_once __DIR__.'/../lib/bootstrap.php';

$person = \MusicFestival\Person::fromName($_GET['person'],@$_GET['playlist']);
$track  = $person->getTrack($_GET['track']);
$link   = $track->getLink($_GET['link']);

if($link->hasPlayer()) {
  echo $link->__toString();
} else {
  header("Location: {$link->getUrl()}");
}


