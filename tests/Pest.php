<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

use Okolaa\TermiiPHP\Termii;
use Saloon\Config;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Tests\TestCase;

pest()->extend(Tests\TestCase::class)
    ->group('feature')
    ->in('Feature');


pest()->extend(Tests\TestCase::class)
    ->group('unit')
    ->in('Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function createTestConnector(?MockClient $mockClient = null): \Okolaa\TermiiPHP\TermiiConnector
{

    $connector = Termii::initialize('api-key');
    $connector->getAuthenticator();

    if ($mockClient !== null) {
        $connector->withMockClient($mockClient);
    }

    return $connector;
}

function createTestEndpoint(Method $method = Method::GET): Request
{
    return new class($method) extends Request implements HasBody {
        use HasJsonBody;

        public function __construct(Method $method)
        {
            $this->method = $method;
        }

        public function resolveEndpoint(): string
        {
            return '/test';
        }
    };
}


Config::preventStrayRequests();

uses()
    ->beforeEach(fn() => MockClient::destroyGlobal())
    ->beforeEach(fn() => TestCase::initGlobalMockClient())
    ->in(__DIR__);
