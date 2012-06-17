<?php

namespace MusicFestival\Link;

class YouTubeLink extends \MusicFestival\Link\PlayerLink {
  public function getIcon() {
    return "images/link/youtube.png";
  }

  public function getName() {
    return "YouTube";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://(www.)?youtu(be\.com|\.be)/.*#', $url);
  }

  public function getPlayer() {
    return new \MusicFestival\Player\YouTubePlayer($this);
  }
}