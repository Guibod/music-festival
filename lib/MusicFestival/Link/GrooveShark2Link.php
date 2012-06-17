<?php

namespace MusicFestival\Link;

class GrooveShark2Link extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "images/link/grooveshark.png";
  }

  public function getName() {
    return "Groove Shark";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://(www.)?grooveshark.com/.+#', $url);
  }
}