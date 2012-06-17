<?php

namespace MusicFestival\Link;

abstract class PlayerLink extends \MusicFestival\Link\DefaultLink {
  public function __construct($url) {
    $this->url = $url;

    if(preg_match('#http://open.spotify.com/track/(?<id>.*)#', $url, $match))
    {
      $this->id = $match['id'];
    }
  }

  public function hasPlayer()
  {
    return true;
  }

  public function getTemplate() {
    return "link/player.twig";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://open.spotify.com/track/.*#', $url);
  }
}