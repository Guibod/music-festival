<?php

namespace MusicFestival;

class Person extends Entity {
  const ATTR_ID   = 'id';
  const ATTR_NAME = 'name';

  protected $tracks = array();
  protected $socials = array();

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
   * @return array<SocialAccount>
   */
  function getSocialAccounts() {
    return $this->socials;
  }

  /**
   * @param array $tracks
   */
  function setTracks(array $tracks)
  {
    $this->tracks = $tracks;
  }

  /**
   * @param array $socialAccounts
   */
  function setSocialAccounts(array $socialAccounts)
  {
    $this->socials = $socialAccounts;
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
      $tracks = array();
      foreach($array['tracks'] as $track)
      {
        $tracks[] = Track::fromArray($track);
      }
      $person->setTracks($tracks);
    }

    if(isset($array['social']) && is_array($array['social']))
    {
      $socials = array();
      foreach($array['social'] as $social)
      {
        $socials[] = SocialAccount::fromUrl($social);
      }
      $person->setSocialAccounts($socials);
    }

    return $person;
  }
}