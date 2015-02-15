<?php

namespace BoosBoos\Charta\IO;

/**
 * @package BoosBoos\Charta\IO
 */
abstract class FileType
{
  /**
   * @var string
   */
  const CSV = "csv";

  /**
   * @var string
   */
  const JSON = "json";

  /**
   * @var string
   */
  const UNKNOWN = "unknown";
}
