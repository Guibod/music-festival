<?php

namespace MusicFestival;

class Config {
  private $settings;
  private $lastfm;
  private $twig;
  private $cache;

  /**
   * @var Config
   */
  private static $_instance = null;

  function __construct() {
    $this->settings = \Symfony\Component\Yaml\Yaml::parse(\MUSICFESTIVAL_DIR.'/config/settings.yml');

    $this->lastfm = new \Lastfm\Client($this->settings['lastfm']['key']);
    $this->lastfm->setTransport(new \MusicFestival\Transport\CachedCurl());

    $this->twig = new \Twig_Environment(
      new \Twig_Loader_Filesystem(MUSICFESTIVAL_DIR.'/templates'),
      array('cache' => MUSICFESTIVAL_DIR.'/cache/twig')
    );

    $this->cache = new \Cache_Lite(array(
      'cacheDir' => MUSICFESTIVAL_DIR.'/cache/twig',
      'lifeTime' => 3600
    ));

    if(isset($_GET['nocache']))
    {
      $this->cache->setLifeTime(0);
    }
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
    return $this->twig;
  }

  /**
   * @return \Cache_Lite
   */
  function getCache()
  {
    return $this->cache;
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