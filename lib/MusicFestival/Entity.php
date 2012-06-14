<?php

namespace MusicFestival;

abstract class Entity {

  protected $attributes = array();

  function __construct(array $attributes) {
    foreach ($attributes as $attrName) {
      $this->attributes[$attrName] = null;
    }
  }

  /**
   * @param string $key
   * @return bool
   */
  function hasAttribute($key) {
    return array_key_exists($key, $this->attributes);
  }

  /**
   * @param string $key
   * @return mixed
   * @throws Exception
   */
  function getAttribute($key) {
    if ($this->hasAttribute($key)) {
      return $this->attributes[$key];
    }
    throw new \UnexpectedValueException(sprintf("Unknown attribute '%s' on '%s' object.", $key, get_class($this)));
  }

  /**
   * @param string $key
   * @param mixed $value
   */
  function setAttribute($key, $value, $doNotOverride = false) {
    if (!$this->hasAttribute($key)) {
      throw new \UnexpectedValueException(sprintf("Unknown attribute '%s' on '%s' object.", $key, get_class($this)));
    }
    if($this->attributes[$key] && $doNotOverride) {
      return;
    }

    $this->attributes[$key] = $value;
  }

  /**
   * @param array $array
   * @return \MusicFestival\Entity
   */
  function setAttributes(array $array) {
    foreach ($array as $key => $value) {
      if ($this->hasAttribute($key)) {
        $this->setAttribute($key, $value);
      }
    }
  }

}