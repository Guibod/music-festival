<?php

namespace MusicFestival\Link;

class YouTubeLink extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "images/link/youtube.png";
  }

  public function getName() {
    return "YouTube";
  }

  public function getTemplate() {
    return "link/youtube.twig";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://(www.)?youtu(be\.com|\.be)/.*#', $url);
  }

  public function hasPlayer() {
    return true;
  }

  public function getPlayer() {
    return new \MusicFestival\Player\YouTubePlayer($this);
  }
}