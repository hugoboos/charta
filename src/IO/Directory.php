<?php

namespace BoosBoos\Charta\IO;

/**
 * @package BoosBoos\Charta\IO
 */
class Directory
{
  /**
   * @var int
   */
  const DEFAULT_MODE = 0755;

  /**
   * @var string
   */
  private $directory;

  /**
   * @param string $path
   */
  public function __construct($path)
  {
    $this->directory = $this->extractDirectory($path);
  }

  /**
   * @param int $mode
   */
  public function create($mode = self::DEFAULT_MODE)
  {
    mkdir($this->directory, $mode, true);
  }

  /**
   * @return bool
   */
  public function exists()
  {
    return file_exists($this->directory);
  }

  /**
   * @param string $path
   * @return string
   */
  private function extractDirectory($path)
  {
    return pathinfo($path, PATHINFO_DIRNAME);
  }
}
