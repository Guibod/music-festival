<?php

namespace MusicFestival\Player;

class VimeoPlayer implements \MusicFestival\Player\Player {
  protected $link;
  protected $id;

  public function __construct(\MusicFestival\Link\Link $link) {
    $this->link = $link;
    if(preg_match('#http://vimeo.com/(?<id>\d+)#', $link->getUrl(), $match)) {
      $this->id = $match['id'];
    }
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
    return 'player/vimeo.twig';
  }

  public function isValid() {
    return $this->getLink()->isValid();
  }

  public function getLink() {
    return $this->link;
  }

}