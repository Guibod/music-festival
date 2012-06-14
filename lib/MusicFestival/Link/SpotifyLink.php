<?php

namespace MusicFestival\Link;

class SpotifyLink extends \MusicFestival\Link\DefaultLink {
  public function __construct($url) {
    $this->url = $url;

    if(preg_match('#http://open.spotify.com/track/(?<id>.*)#', $url, $match))
    {
      $this->id = $match['id'];
    }
  }

  public function getSpotifyId() {
    return $this->id;
  }

  public function getSpotifyUri() {
    return "spotify:track:$this->id";
  }

  public function getIcon() {
    return "http://www.simounet.net/uploads/2009/02/spotify_logo.jpg";
  }

  public function getName() {
    return "Spotify";
  }

 public function getTemplate() {
    return "link/spotify.twig";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://open.spotify.com/track/.*#', $url);
  }
}