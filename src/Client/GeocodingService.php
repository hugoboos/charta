<?php

namespace BoosBoos\Charta\Client;

use BoosBoos\Charta\Common\Throttler;
use BoosBoos\Charta\Http;

/**
 * @package BoosBoos\Charta\Client
 */
class GeocodingService
{
  /**
   * @var int
   */
  const REQUESTS_PER_SECOND = 10;

  /**
   * @var string
   */
  const STATUS_OK = "OK";

  /**
   * @var \BoosBoos\Charta\Http\ClientInterface
   */
  private $httpClient;

  /**
   * @var \BoosBoos\Charta\Http\Url
   */
  private $endPointUrl;

  /**
   * @var \BoosBoos\Charta\Common\Throttler
   */
  private $throttler;

  /**
   * @param \BoosBoos\Charta\Http\ClientInterface $httpClient
   * @param \BoosBoos\Charta\Http\Url $endPointUrl
   */
  public function __construct(Http\ClientInterface $httpClient, Http\Url $endPointUrl)
  {
    $this->httpClient = $httpClient;
    $this->endPointUrl = $endPointUrl;

    $this->throttler = new Throttler(self::REQUESTS_PER_SECOND);
  }

  /**
   * @param string $query
   * @return \BoosBoos\Charta\Client\GeoCoordinates|null
   */
  public function lookup($query)
  {
    $url = clone $this->endPointUrl;
    $url->setQueryStringParameter("address", $query);

    $this->throttler->throttle();

    $response = $this->httpClient->get($url);

    $geo = null;

    if ($response !== null && $response->getStatusCode() === Http\StatusCode::OK) {
      $geo = $this->parseResponse($response->getJson());
    }

    return $geo;
  }

  /**
   * @param \stdClass $response
   * @return \BoosBoos\Charta\Client\GeoCoordinates
   */
  private function parseResponse($response)
  {
    $geo = null;

    if ($response->status !== self::STATUS_OK) {
      return $geo;
    }

    $results = new \ArrayObject($response->results);

    if ($results->count() === 0) {
      return $geo;
    }

    $result = $results->offsetGet(0);
    $location = $result->geometry->location;

    $geo = $this->createGeoCoordinates($location->lat, $location->lng);

    return $geo;
  }

  /**
   * @param float $latitude
   * @param float $longitude
   * @return \BoosBoos\Charta\Client\GeoCoordinates
   */
  private function createGeoCoordinates($latitude, $longitude)
  {
    return new GeoCoordinates($latitude, $longitude);
  }
}
