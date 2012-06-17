<?php

require_once __DIR__.'/../lib/bootstrap.php';

$person = \MusicFestival\Person::fromName($_GET['person'],@$_GET['playlist']);
$track  = $person->getTrack($_GET['track']);

echo $track->getMemo();
