<?php

namespace MusicFestival\Link;

class GrooveSharkLink extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "images/link/grooveshark.png";
  }

    public function hasPlayer()
  {
    return true;
  }

  public function getPlayer()
  {
    return new \MusicFestival\Player\GrooveSharkPlayer($this);
  }

  public function getName() {
    return "Groove Shark";
  }

  public function getTemplate() {
    return "link/grooveshark.twig";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://(www.)?grooveshark.com/s/.+#', $url);
  }
}