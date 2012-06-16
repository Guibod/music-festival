<?php

namespace MusicFestival\Link;

class LastFmLink extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "images/link/lastfm.png";
  }

  public function getName() {
    return "last.fm";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://www.last(\.fm|fm\.fr)/music/.*#', $url);
  }
}