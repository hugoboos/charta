<?php

namespace BoosBoos\Charta\Http;

/**
 * @package BoosBoos\Charta\Http\Client
 */
class Client implements IClient
{
  /**
   * @param \BoosBoos\Charta\Http\Url $url
   * @return \BoosBoos\Charta\Http\Response
   */
  public function get(Url $url)
  {
    $handle = curl_init($url);

    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

    $body = curl_exec($handle);
    $info = curl_getinfo($handle);
    $error = curl_errno($handle);

    $response = null;

    if ($error === 0) {
      $response = new Response($info["http_code"], $body);
    }

    curl_close($handle);

    return $response;
  }
}
