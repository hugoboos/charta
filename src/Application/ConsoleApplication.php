<?php

namespace BoosBoos\Charta\Application;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;

/**
 * @package BoosBoos\Charta\Application
 */
class ConsoleApplication extends Application
{
  const VERSION = "0.1.0";

  /**
   * Constructor.
   */
  public function __construct()
  {
    parent::__construct("charta", self::VERSION);
  }

  /**
   * {@inheritdoc}
   */
  public function getDefinition()
  {
    $inputDefinition = parent::getDefinition();

    // Clear out the normal first argument, which is the command name.
    $inputDefinition->setArguments();

    return $inputDefinition;
  }

  /**
   * {@inheritdoc}
   *
   * @SuppressWarnings(PHPMD.UnusedFormalParameter)
   */
  protected function getCommandName(InputInterface $input)
  {
    return "convert";
  }

  /**
   * {@inheritdoc}
   */
  protected function getDefaultCommands()
  {
    $defaultCommands = parent::getDefaultCommands();

    $defaultCommands[] = new ConvertCommand();

    return $defaultCommands;
  }
}
