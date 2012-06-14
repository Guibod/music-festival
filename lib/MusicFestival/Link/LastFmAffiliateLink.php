<?php

namespace MusicFestival\Link;

class LastFmAffiliateLink implements \MusicFestival\Link\Link {
  const UNAVAILABLE = 'unavailable';

  protected $valid = true;
  /**
   * @var Link
   */
  protected $link;
  protected $url;

  public function __construct($url)
  {
    $this->url = $url;
    if(!preg_match('#http://www.last.fm/affiliate/byid/9/(?<trackId>\d+)/(?<affiliateId>\d+)/trackpage/\1#', $url, $match))
    {
      $this->valid = false;
    } else {
      $redirect = $this->getRedirect();
      if(!$redirect || self::UNAVAILABLE == $redirect) {
        $this->valid = false;
      }
    }

    if($this->valid) {
      $this->link = \MusicFestival\Link\Factory::fromUrl($redirect);
    }
  }

  public function getIcon() {
    if($this->valid) {
      return $this->link->getIcon();
    }
    return null;
  }

  public function getName() {
    if($this->valid) {
      return $this->link->getName();
    }
    return null;
  }

  public static function isMatchingUrl($url) {
    return (bool) preg_match('#http://www.last.fm/affiliate/byid/.*#', $url);
  }

  protected function getRedirect() {
    $cache = \MusicFestival\Config::getInstance()->getCache();

    if($cache->get($this->url)) {
      return $cache->get($this->url);
    }
    $redirect = self::UNAVAILABLE;
    $ch = curl_init($this->url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_exec($ch);

    $info = \curl_getinfo($ch);
    if($info['redirect_url']) {
      $redirect = $info['redirect_url'];
    }
    curl_close($ch);

    $cache->save($redirect, $this->url);
    return $redirect;
  }

  public function __toString() {
    if($this->valid) {
      return $this->link->__toString();
    }
    return '';
  }

  public function getTemplate() {
    if($this->valid) {
      return $this->link->getTemplate();
    }
    return null;
  }

  public function getUrl() {
    if($this->valid) {
      return $this->link->getUrl();
    }
    return null;
  }

  public function isValid() {
    return $this->valid;
  }
}