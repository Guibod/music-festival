<?php

namespace MusicFestival;

class Config {

  static function read($file)
  {
    $yaml = new \Symfony\Component\Yaml\Yaml();
    $config = $yaml->parse($file);

    $output = array();
    foreach($config as $person)
    {
      $output[] = \MusicFestival\Person::fromArray($person);
    }

    return $output;
  }
}