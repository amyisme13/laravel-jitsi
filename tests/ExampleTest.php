<?php

namespace Amyisme13\LaravelJitsi\Tests;

use Amyisme13\LaravelJitsi\LaravelJitsiServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelJitsiServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
