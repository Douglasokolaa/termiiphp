<?php

namespace Tests;

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Okolaa\TermiiPHP\Termii;

class TermiiTest extends TestCase
{

  public function __construct()
  {
    parent::__construct();
    $dotenv = Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();
  }

  /**
   * check if the Termii has no syntax error 
   *
   * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
   * any typo before you even use this library in a real project.
   *
   */
  public function testCheckForSyntaxError()
  {
    $termii = new Termii;
    $this->assertTrue(is_object($termii));
    unset($termii);
  }

}
