<?php

namespace MusicFestival;

class Person {
  protected $name;

  /**
   * @return string
   */
  function getName() {
    return $this->name;
  }

  /**
   * @param array $array
   * @return \MusicFestival\Person
   */
  static function fromArray(array $array) {
    $person = new Person();
    $person->name = $array['name'];

    return $person;
  }

}