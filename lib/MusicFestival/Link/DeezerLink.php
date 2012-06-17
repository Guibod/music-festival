<?php

namespace MusicFestival\Link;

class DeezerLink extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "images/link/deezer.png";
  }

  public function getName() {
    return "Deezer";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://www.deezer.com/(\.+/)?music/.*#', $url);
  }
}