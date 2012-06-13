<?php

namespace MusicFestival\Link;

require_once 'LinkTest.php';

class DefaultLinkTest extends LinkTest {

  public function getMatchingUrl() {
    return 'http://www.whatever.com/';
  }

  public function getNonMatchingUrl() {
    return null;
  }

  public function getTestedClassName() {
    return '\MusicFestival\Link\DefaultLink';
  }

  public function getValidLinkInstance() {
    return new \MusicFestival\Link\DefaultLink($this->getMatchingUrl());
  }

}