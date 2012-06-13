<?php

namespace MusicFestival\Link;

class DefaultLink implements \MusicFestival\Link\Link {
  protected $url;

  public function __construct($url) {
    $this->url = $url;
  }

  public function getIcon() {
    return "http://www.zug.com/img/icon-link.jpg";
  }

  public function getName() {
    return "Link";
  }

  public function getTemplate() {
    return "default";
  }

  public function getUrl() {
    return $this->url;
  }

  public static function isMatchingUrl($url) {
    return (bool) $url;
  }

}