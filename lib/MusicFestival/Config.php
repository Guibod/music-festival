<?php

namespace MusicFestival;

class Config {
  private $settings;
  private $lastfm;

  /**
   * @var Config
   */
  private static $_instance = null;

  function __construct() {
    $this->settings = \Symfony\Component\Yaml\Yaml::parse(\MUSICFESTIVAL_DIR.'/config/settings.yml');
    $this->lastfm = new \Lastfm\Client($this->settings['lastfm']['key']);
  }

  /**
   * @return array
   */
  function getSettings()
  {
    return $this->settings;
  }

  /**
   * @return \Lastfm\Client
   */
  function getLastFmClient()
  {
    return $this->lastfm;
  }

  /**
   * @return \Twig_Environment
   */
  function getTwig()
  {
    $conf = array();
    if(!isset($_GET['nocache']) || !$_GET['nocache'])
    {
      $conf['cache'] = MUSICFESTIVAL_DIR.'/cache';
    }

    return new \Twig_Environment(
      new \Twig_Loader_Filesystem(MUSICFESTIVAL_DIR.'/templates'),
      $conf
    );
  }

  /**
   * @return Config
   */
  public static function getInstance() {
    if (is_null(self::$_instance)) {
      self::$_instance = new Config();
    }

    return self::$_instance;
  }

  static function read($file) {
    $yaml = new \Symfony\Component\Yaml\Yaml();
    $config = $yaml->parse($file);

    $output = array();

      $output[] = \MusicFestival\Person::fromArray($config);

    return $output;
  }

}