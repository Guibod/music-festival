<?php

namespace MusicFestival\Link;

class VimeoLink extends \MusicFestival\Link\DefaultLink {
  public function getIcon() {
    return "images/link/vimeo.png";
  }

  public function getName() {
    return "Vimeo";
  }

  public function getTemplate() {
    return "link/vimeo.twig";
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://(www.)?vimeo.com/.*#', $url);
  }

  public function hasPlayer() {
    return true;
  }

  public function getPlayer() {
    return new \MusicFestival\Player\VimeoPlayer($this);
  }
}