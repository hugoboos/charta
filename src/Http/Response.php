<?php

namespace BoosBoos\Charta\Http;

/**
 * @package BoosBoos\Charta\Http
 */
class Response
{
  /**
   * @var int
   */
  private $statusCode;

  /**
   * @var string
   */
  private $body;

  /**
   * @param int $statusCode
   * @param string $body
   */
  public function __construct($statusCode, $body = null)
  {
    $this->statusCode = $statusCode;
    $this->body = $body;
  }

  /**
   * The status code.
   * @return int
   */
  public function getStatusCode()
  {
    return $this->statusCode;
  }

  /**
   * The response body.
   * @return string
   */
  public function getBody()
  {
    return $this->body;
  }

  /**
   * The response body as JSON.
   * @return mixed
   */
  public function getJson()
  {
    return json_decode($this->body);
  }
}
