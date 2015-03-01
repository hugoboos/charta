<?php

namespace BoosBoos\Charta\IO;

/**
 * @package BoosBoos\Charta\IO
 */
interface FileInterface
{
  /**
   * Reads the file into memory.
   */
  public function read();

  /**
   * Writes the contents to disk.
   */
  public function write();

  /**
   * Checks if the file exists.
   * @return bool
   */
  public function exists();

  /**
   * Gets the type of the file.
   * @return string
   */
  public function getFileType();

  /**
   * Gets the contents of the file.
   * @return mixed
   */
  public function getContents();

  /**
   * Sets the contents of the file.
   * @param mixed $contents
   */
  public function setContents($contents);
}
