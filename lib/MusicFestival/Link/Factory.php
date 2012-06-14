<?php

namespace MusicFestival\Link;

class Factory {

  static function getDefaultClasses() {
    return array(
      '\MusicFestival\Link\LastFmLink',
      '\MusicFestival\Link\YouTubeLink',
      '\MusicFestival\Link\SpotifyLink',
      '\MusicFestival\Link\DeezerLink',
      '\MusicFestival\Link\HypemLink',
      '\MusicFestival\Link\LastFmAffiliateLink',
      '\MusicFestival\Link\DefaultLink',
    );
  }

  static function fromUrl($url) {
    $classes = self::getDefaultClasses();

    foreach ($classes as $class) {
      if ($class::isMatchingUrl($url)) {
        return new $class($url);
      }
    }
  }

}