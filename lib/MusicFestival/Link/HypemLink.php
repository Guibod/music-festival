<?php

namespace MusicFestival\Link;

class HypemLink extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "http://www.softoxi.com/media/image/000/007/the-hype-machine.jpg";
  }

  public function getName() {
    return "Hype Machine";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://hypem.com/item/.*#', $url);
  }
}