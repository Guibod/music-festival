<?php

namespace MusicFestival\Link;

class GrooveShark2Link extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "images/link/grooveshark.png";
  }

    public function hasPlayer()
  {
    return false; //broken atm
  }

  public function getPlayer()
  {
    //return new \MusicFestival\Player\GrooveSharkPlayer($this);
  }

  public function getName() {
    return "Groove Shark";
  }

  public function getTemplate() {
    return "link/grooveshark.twig";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://(www.)?grooveshark.com/.+#', $url);
  }
}