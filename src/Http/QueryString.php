<?php

namespace BoosBoos\Charta\Http;

/**
 * @package BoosBoos\Charta\Http
 */
class QueryString
{
  /**
   * @var \ArrayObject
   */
  private $parameters;

  /**
   *
   */
  public function __construct()
  {
    $this->parameters = new \ArrayObject();
  }

  /**
   * @param string $name
   * @param string $value
   */
  public function setParameter($name, $value)
  {
    $this->parameters->offsetSet((string)$name, (string)$value);
  }

  /**
   * @return bool
   */
  public function hasParameters()
  {
    return ($this->parameters->count() > 0);
  }

  /**
   * @return string
   */
  public function __toString()
  {
    $string = "";

    foreach ($this->parameters as $name => $value) {
      if ($string !== "") {
        $string .= "&";
      }

      $string .= rawurlencode($name);

      if ($value !== null) {
        $string .= "=" . rawurlencode($value);
      }
    }

    return $string;
  }
}
