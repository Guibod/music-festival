<?php

namespace MusicFestival\Link;

class SoundCloudLink extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "images/link/soundcloud.png";
  }
/*
  public function getPlayer()
  {
    return new \MusicFestival\Player\SoundCloudPlayer($this);
  }
*/
  public function getName() {
    return "SoundCloud";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://(www\.)?soundcloud.com/.*#', $url);
  }
}