<?php

namespace MusicFestival\Link;

class YouTubeLink extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "http://www.detailrecordings.com/wp-content/uploads/2012/04/YOUTUBE-Logo.gif";
  }

  public function getName() {
    return "YouTube";
  }

  public function getTemplate() {
    return "link/youtube.twig";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://www.youtube.com/.*#', $url);
  }

  public function hasPlayer() {
    return true;
  }

  public function getPlayer() {
    return new \MusicFestival\Player\YouTubePlayer($this);
  }
}