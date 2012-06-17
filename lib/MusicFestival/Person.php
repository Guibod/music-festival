<?php

namespace MusicFestival;

class Person extends Entity {
  const ATTR_ID   = 'id';
  const ATTR_NAME = 'name';
  const ATTR_SECRET = 'secret';

  protected $tracks = array();
  protected $socials = array();

  function __construct($id)
  {
    parent::__construct(array(
      self::ATTR_NAME,
      self::ATTR_ID,
      self::ATTR_SECRET,
    ));
    $this->setAttribute(self::ATTR_ID, $id);
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
   * @return string
   */
  function getSecret() {
    return $this->getAttribute(self::ATTR_SECRET);
  }

  /**
   * @return array<Track>
   */
  function getTracks() {
    return $this->tracks;
  }

  /**
   * @return Track
   */
  function getTrack($key) {
    if(!isset($this->tracks[$key])) {
      throw new Exception("Track #$key not found for {$this->getName()}.");
    }

    return $this->tracks[$key];
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
  static function fromArray($id, array $array) {
    $person = new Person($id);
    $person->setAttributes($array, true);

    if(isset($array['tracks']) && is_array($array['tracks']))
    {
      $tracks = array();
      foreach($array['tracks'] as $track)
      {
        $tracks[] = Track::fromArray($track);
      }
      $person->setTracks($tracks);
    }

//    if(isset($array['social']) && is_array($array['social']))
//    {
//      $socials = array();
//      foreach($array['social'] as $social)
//      {
//        $socials[] = SocialAccount::fromUrl($social);
//      }
//      $person->setSocialAccounts($socials);
//    }

    return $person;
  }

  /**
   * @param string $file
   * @return \MusicFestival\Person
   */
  static function fromYaml($file) {
    $yaml = new \Symfony\Component\Yaml\Yaml();

    $config = $yaml->parse($file);
    if($config == $file)
    {
      throw new \Exception("Unable to read $file.");
    }

    return self::fromArray(pathinfo($file, PATHINFO_FILENAME), $config);
  }

  /**
   *
   * @param string $name
   * @return \MusicFestival\Person
   * @throws \Exception
   */
  static function fromName($name) {
    $settings = \MusicFestival\Config::getInstance()->getSettings();
    $directory = $settings['playlist']['dir'];

    $file = $directory.DIRECTORY_SEPARATOR.$name.'.yml';

    if(\file_exists($file)) {
      return self::fromYaml($file);
    }

    $file = \MUSICFESTIVAL_DIR.\DIRECTORY_SEPARATOR."cache/yml/$name.yml";
    if(\file_exists($file)) {
      return self::fromYaml($file);
    }

    throw new \Exception("No file found for $name.");
  }
}