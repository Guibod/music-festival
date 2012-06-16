<?php

namespace MusicFestival\Player;

class YouTubePlayer implements \MusicFestival\Player\Player {
  protected $link;
  protected $id;

  public function __construct(\MusicFestival\Link\Link $link) {
    $this->link = $link;
    $query = parse_url($link->getUrl(), PHP_URL_QUERY);
    parse_str($query, $pquery);
    $this->id   = $pquery['v'];
  }

  public function getVideoId() {
    return $this->id;
  }

  public function __toString() {
    try {
      $twig = \MusicFestival\Config::getInstance()->getTwig();
      return  $twig->render($this->getTemplate(), array('player' => $this));
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function getTemplate() {
    return 'player/youtube.twig';
  }

  public function isValid() {
    return $this->getLink()->isValid();
  }

  public function getLink() {
    return $this->link;
  }

}