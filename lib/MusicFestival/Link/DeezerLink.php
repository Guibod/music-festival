<?php

namespace MusicFestival\Link;

class DeezerLink extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "http://media.abonnez-vous.orange.fr/medias/visuel/image/logo-deezer-mini.gif";
  }

  public function getName() {
    return "Deezer";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://www.deezer.com/(.+/)?music/track/.*#', $url);
  }
}