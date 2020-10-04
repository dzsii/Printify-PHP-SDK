<?php

namespace Printify\Tests;

use Exception;
use Printify\PrintifyApiClient;
use Printify\Tests\Credentials;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $api;

    protected function setUp()
    {
        parent::setUp();

        if (!class_exists(Credentials::class)) {
            throw new Exception('Printify test credentials are not set. Copy "tests/Credentials.php.dist" to "tests/Credentials.php and enter your token');
        }

        $this->api = new PrintifyApiClient(Credentials::$token);
    }

}
