<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Okolaa\TermiiPhp\Termii;

class TermiiTest extends TestCase
{
  /**
   * check if the Termii has no syntax error 
   *
   * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
   * any typo before you even use this library in a real project.
   *
   */
  public function testCheckForSyntaxError()
  {
    $var = new Termii;
    $this->assertTrue(is_object($var));
    unset($var);
  }
}
