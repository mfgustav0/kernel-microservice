<?php

namespace Tests\Shared;

use Tests\Shared\Traits\UseAdmin;
use Tests\Shared\Traits\UseCustomer;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations;
    use UseCustomer;
    use UseAdmin;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../../bootstrap/app.php';
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }
}
