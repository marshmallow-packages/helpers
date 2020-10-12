<?php

namespace Marshmallow\HelperFunctions\Tests;

use Illuminate\Foundation\Application;
use Marshmallow\HelperFunctions\ServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
}
