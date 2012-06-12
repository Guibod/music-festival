<?php

namespace MusicFestival\Transport;

class CachedCurl extends \Lastfm\Transport\Curl {


  public function request($httpMethod, $apiMethod, array $parameters = array(), array $options = array()) {
    $cache = \MusicFestival\Config::getInstance()->getCache();
    $cacheKey = md5($httpMethod.$apiMethod.var_export($parameters, true).var_export($options, true));

    $value = $cache->get($cacheKey);
    if($value)
    {
      return $value;
    }


    try {
      $return = parent::request($httpMethod, $apiMethod, $parameters, $options);
      $cache->save($return, $cacheKey);
    } catch (\Exception $e) {

    }

    return $return;
  }

}