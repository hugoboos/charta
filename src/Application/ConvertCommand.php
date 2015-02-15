<?php

namespace BoosBoos\Charta\Application;

use BoosBoos\Charta\Client;
use BoosBoos\Charta\Http;
use BoosBoos\Charta\IO;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package BoosBoos\Charta\Console
 */
class ConvertCommand extends Command
{
  /**
   * {@inheritdoc}
   */
  protected function configure()
  {
    $this
      ->setName("convert")
      ->setDescription('Convert')
      ->addArgument(
        "inputFileName",
        InputArgument::REQUIRED,
        "Input file name"
      )
      ->addArgument(
        "outputFileName",
        InputArgument::REQUIRED,
        "Output file name"
      );
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $endPointUrl = new Http\Url("https://maps.googleapis.com/maps/api/geocode/json");

    $geoLocationService = new Client\GeocodingService(
      new Http\Client(),
      $endPointUrl
    );

    $geoLocationResolver = new Client\GeoLocationResolver(
      $geoLocationService
    );

    $fileFactory = new IO\FileFactory();

    $inputFileName = $input->getArgument("inputFileName");
    $outputFileName = $input->getArgument("outputFileName");

    $converter = new Converter(
      $fileFactory->createFile($inputFileName),
      $fileFactory->createFile($outputFileName),
      $geoLocationResolver
    );

    $exportedClients = $converter->convert();

    $output->writeln("Exported clients: " . $exportedClients);
  }
}
