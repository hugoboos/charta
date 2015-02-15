<?php

namespace BoosBoos\Charta\Http;

/**
 * @package BoosBoos\Charta\Http
 */
interface IClient
{
  /**
   * @param \BoosBoos\Charta\Http\Url $url
   * @return \BoosBoos\Charta\Http\Response
   */
  public function get(Url $url);
}
