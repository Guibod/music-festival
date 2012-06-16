<?php

namespace MusicFestival\Player;

class DeezerPlayer implements \MusicFestival\Player\Player {
  protected $link;

  public function __construct(\MusicFestival\Link\Link $link) {
    $this->link = $link;
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
    return 'player/deezer.twig';
  }

  public function isValid() {
    return $this->getLink()->isValid();
  }

  public function getLink() {
    return $this->link;
  }

}