<?php

namespace MusicFestival\Link;

class VimeoLink extends \MusicFestival\Link\PlayerLink {
  public function getIcon() {
    return "images/link/vimeo.png";
  }

  public function getName() {
    return "Vimeo";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://(www.)?vimeo.com/.*#', $url);
  }

  public function getPlayer() {
    return new \MusicFestival\Player\VimeoPlayer($this);
  }
}