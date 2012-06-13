<?php

namespace MusicFestival\Link;

require_once 'LinkTest.php';

class LastFmLinkTest extends LinkTest {

  public function getMatchingUrl() {
    return 'http://www.lastfm.fr/music/Serge+Gainsbourg/_/La+Javanaise?ac=java';
  }

  public function getNonMatchingUrl() {
    return 'http://www.youtub.com/niik';
  }

  public function getTestedClassName() {
    return '\MusicFestival\Link\LastFmLink';
  }

  public function getValidLinkInstance() {
    return new \MusicFestival\Link\LastFmLink($this->getMatchingUrl());
  }

}