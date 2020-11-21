<?php

namespace Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use Okolaa\TermiiPHP\Insight;

class InsightTest extends TestCase
{
    protected $verifySSL = false;

    public function __construct()
    {
        parent::__construct();
        $dotenv = Dotenv::createImmutable(__DIR__ . "/..");
        $dotenv->load();
    }

    /**
     * check if the Termii has no syntax error 
     */
    public function testCheckForSyntaxError()
    {
        $termii = new Insight;
        $this->assertTrue(is_object($termii));
        unset($termii);
    }

    public function testGetSenderIds()
    {
        $termii = new Insight();
        $termii->setAPIKey($_ENV["TERMII_API_KEY"]);

        // Disable Verify SSL in Guzzle
        $termii->verifySSL = $this->verifySSL;

        $response = $termii->getSenderIds();

        $this->assertIsArray($response, "Invalid Response");
    }

    public function testGetBallance()
    {
        $termii = new Insight();
        $termii->setAPIKey($_ENV["TERMII_API_KEY"]);

        // Disable Verify SSL in Guzzle
        $termii->verifySSL = $this->verifySSL;

        $response = $termii->getBallance();

        $this->assertIsArray($response, "Invalid Response");
    }

    public function testSearch()
    {

        $termii = new Insight();
        $termii->setAPIKey($_ENV["TERMII_API_KEY"]);

        // Disable Verify SSL in Guzzle
        $termii->verifySSL = $this->verifySSL;

        $response = $termii->search($_ENV["TEST_PHONE_NUMBER"]);
        $this->assertIsArray($response, "Invalid Response");
    }
}
