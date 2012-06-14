<?php

namespace MusicFestival\Link;

class YouTubeLink extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "http://www.detailrecordings.com/wp-content/uploads/2012/04/YOUTUBE-Logo.gif";
  }

  public function getName() {
    return "YouTube";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://www.youtube.com/.*#', $url);
  }
}