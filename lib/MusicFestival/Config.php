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
    \Symfony\Component\Yaml\Yaml::enablePhpParsing();
    $this->settings = \Symfony\Component\Yaml\Yaml::parse(\MUSICFESTIVAL_DIR.'/config/settings.yml');

    $this->lastfm = new \Lastfm\Client($this->settings['lastfm']['key']);
    $this->lastfm->setTransport(new \MusicFestival\Transport\CachedCurl());

    $this->twig = new \Twig_Environment(
      new \Twig_Loader_Filesystem(MUSICFESTIVAL_DIR.'/templates'),
      $this->settings['twig']
    );

    $this->cache = new \Cache_Lite($this->settings['cache']);

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

  public function getPersons() {
    $settings = \MusicFestival\Config::getInstance()->getSettings();
    $directory = $settings['playlist']['dir'];
    $persons = array();

    if ($handle = opendir($directory)) {
      while (false !== ($entry = readdir($handle))) {
        try {
          if(preg_match('/^\S+.yml$/i', $entry)) {
            $persons[$entry] = \MusicFestival\Person::fromYaml($directory.DIRECTORY_SEPARATOR.$entry);
          }
        } catch (Exception $e) {
          // that's ok
        }
      }
      closedir($handle);

      \ksort($persons);
      return $persons;
    }
  }
}