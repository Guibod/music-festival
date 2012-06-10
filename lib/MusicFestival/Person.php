<?php

namespace MusicFestival;

class Person extends Entity {
  const ATTR_ID   = 'id';
  const ATTR_NAME = 'name';

  protected $tracks = array();

  function __construct()
  {
    parent::__construct(array(
      self::ATTR_NAME,
      self::ATTR_ID
    ));
  }

  /**
   * @return string
   */
  function getName() {
    return $this->getAttribute(self::ATTR_NAME);
  }

  /**
   * @return string
   */
  function getId() {
    return $this->getAttribute(self::ATTR_ID);
  }

  /**
   * @return array<Track>
   */
  function getTracks() {
    return $this->tracks;
  }

  /**
   * @param array $tracks
   */
  function setTracks(array $tracks)
  {
    $this->tracks = $tracks;
  }

  /**
   * @param array $array
   * @return \MusicFestival\Person
   */
  static function fromArray(array $array) {
    $person = new Person();
    $person->setAttributes($array);

    if(isset($array['tracks']) && is_array($array['tracks']))
    {
      $person->setTracks(Track::fromArray($array['tracks']));
    }

    return $person;
  }
}