<?php

namespace BoosBoos\Charta\Http;

/**
 * @package BoosBoos\Charta\Http
 */
class Url
{
  /**
   * @var string
   */
  private $url;

  /**
   * @var \BoosBoos\Charta\Http\QueryString
   */
  private $queryString;

  /**
   * @param string $url
   */
  public function __construct($url)
  {
    $this->url = $url;
    $this->queryString = null;
  }

  /**
   * @param string $name
   * @param string $value
   */
  public function setQueryStringParameter($name, $value)
  {
    if ($this->queryString === null) {
      $this->queryString = new QueryString();
    }

    $this->queryString->setParameter($name, $value);
  }

  /**
   * @return string
   */
  public function __toString()
  {
    $url = $this->url;

    $queryString = $this->queryString;

    if ($queryString->hasParameters()) {
      $url .= "?" . $queryString;
    }

    return $url;
  }
}
