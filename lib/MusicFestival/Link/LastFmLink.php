<?php

namespace MusicFestival\Link;

class LastFmLink extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "http://cdn.last.fm/flatness/badges/lastfm_red_small.gif";
  }

  public function getName() {
    return "last.fm";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://www.last(\.fm|fm\.fr)/music/.*#', $url);
  }
}