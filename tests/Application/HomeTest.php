<?php

namespace Tests\Application;

use Carbon\Carbon;
use Tests\Shared\TestCase;

class HomeTest extends TestCase
{
    public function test_user_can_not_list_data_if_not_autenticate(): void
    {
        //Prepare

        //Act
        $this->get('/');

        //Assert
        $this
            ->seeJsonEquals([
                'message' => 'Unauthorized.'
            ])
            ->assertEquals(401, $this->response->status());
    }

    public function test_user_should_list_data_if_autenticate(): void
    {
        //Prepare

        //Act
        $this->get('/', $this->getHeadersCustomer());

        //Assert
        $this
            ->seeHeader('X-RateLimit-Limit', config('ratelimit.api'))
            ->seeHeader('x-ratelimit-remaining', config('ratelimit.api') - 1)
            ->seeJsonEquals([
                'version' => $this->app->version(),
                'today' => Carbon::today()->format('Y-m-d')
            ])
            ->assertEquals(200, $this->response->status());
    }
    
    public function test_user_rate_limit(): void
    {
        if(!env('TEST_RATE_LIMIT')) {
            $this->assertEquals(true, true);
            return;
        }

        foreach(range(1, config('ratelimit.api')) as $i) {
            $this->get('/', $this->getHeadersCustomer())
                ->seeHeader('x-ratelimit-remaining', config('ratelimit.api') - $i)
                ->assertEquals(200, $this->response->status());
        }

        $this->get('/', $this->getHeadersCustomer())
            ->seeHeader('retry-after', 60)
            ->assertEquals(429, $this->response->status());
    }
}
