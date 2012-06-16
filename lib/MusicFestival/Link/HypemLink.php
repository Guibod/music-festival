<?php

namespace MusicFestival\Link;

class HypemLink extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "images/link/hypem.gif";
  }

  public function getName() {
    return "Hype Machine";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://hypem.com/item/.*#', $url);
  }
}